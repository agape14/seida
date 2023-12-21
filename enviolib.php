<?php
require_once 'constantes.php';
require_once 'funciones.php';
require 'vendor/autoload.php'; //1)cd /seida luego ejecutar(composer require pear/http_request2:2.2.1)   2)Agregar el siguiente Path to Composer autoload.php

require_once 'Net/URL2.php';
require_once 'HTTP/Request2.php';
require_once 'HTTP/Request2/Adapter.php';
require_once 'HTTP/Request2/SocketWrapper.php';
require_once 'HTTP/Request2/Response.php';
require_once 'HTTP/Request2/ConnectionException.php';

function envio_seida($mysqli, $billladingid, $billlading, $infocode, $hbl_code, $xml){
	global $ruc;	
	$ruc_veco = $ruc;	
	$request = new HTTP_Request2();
	$request->setUrl('https://test.sunat.gob.pe:444/ol-ad-itseida-ws/ReceptorService.htm?wsdl');
	$request->setMethod(HTTP_Request2::METHOD_POST);
	$request->setConfig(array(
	'follow_redirects' => TRUE,
	 'ssl_verify_peer'   => FALSE,
    'ssl_verify_host'   => FALSE
	));
$request->setHeader(array(
  'Content-Type' => 'text/xml',
));
	
	//Construir XML
	$nombredoc = $infocode."-".$hbl_code;	
	$nombrexml = $nombredoc.".xml";	
	file_put_contents($nombrexml, $xml);
	
	//Firmar XML
	$facturaBase64 = firmarXMLBase64($infocode, $nombredoc);
	
	//Construir envelope
	$nombrezip = $infocode.".zip";
	$envelope = obtenerXMLEnvelope($infocode, $facturaBase64);
	$request->setBody($envelope);
	
	try {
		$response = $request->send();
		var_dump($response);
		if ($response->getStatus() == 200) {
			$xml = obtenerRespuestaXML($response);
			var_dump($xml);
			if(!isset($xml["recibirArchivoResultado"][2]["listaErrores"])){			
				
				$msje =  "AnhoEnvio - ".      $xml["recibirArchivoResultado"][0]["anhoEnvio"]."\n";
				$msje .= "DocumentoEmisor - ".$xml["recibirArchivoResultado"][1]["documentoEmisor"]."\n";
				$msje .= "FechaRecepcion - ". $xml["recibirArchivoResultado"][2]["fechaRecepcion"]."\n";
				$msje .= "hashDocumento - ".  $xml["recibirArchivoResultado"][3]["hashDocumento"]."\n";
				$msje .= "TicketEnvio -".     $xml["recibirArchivoResultado"][5]["ticketEnvio"]."\n";
				
				print($msje."\n");
				
				$sql = "insert into env_seida_resultado values (null,$billladingid,'$hbl_code',1,'$msje','',NOW());";
				$mysqli->query($sql);
				
				return $response->getReasonPhrase();
				
			}
			else {
				$msje="";
				foreach($xml["recibirArchivoResultado"] as $i => $lista){
					 if(isset($lista["listaErrores"])){
						 print($i."-".$lista["listaErrores"][1]["descripcion"]. "\n");
						 $msje.=$lista["listaErrores"][0]["codigo"]."-".$lista["listaErrores"][1]["descripcion"]."\n";
					 }
				}
				$msje=substr($msje,0,999);
				print ($msje."\n");
				
				$sql = "insert into env_seida_resultado values (null,$billladingid,'$hbl_code',0,'$msje','',NOW());";
				$mysqli->query($sql);
				return 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .$response->getReasonPhrase();
			}
		}
		else {
			$msje = $response->getReasonPhrase();
			$sql = "insert into env_seida_resultado values (null,$billladingid,'$hbl_code',0,'$msje','',NOW());";
			$mysqli->query($sql);
			return 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .$response->getReasonPhrase();
		}
	}
	catch(HTTP_Request2_Exception $e) {
		$msje = $e->getMessage();
		$msje = str_replace("'"," ",$msje);
		$msje = str_replace("\\","/",$msje);
		$sql = "insert into env_seida_resultado values (null,$billladingid,'$hbl_code',0,'$msje','',NOW());";
		$mysqli->query($sql);
		return 'Error: ' . $e->getMessage();
	}

}


function enviar_bill_lading($infocode, $hbl_code,$soles=false){
	global $bdserver, $bduser, $bdpass, $bdscheme, $PriceTypeCode;
	
	$mysqli = new mysqli($bdserver, $bduser, $bdpass, $bdscheme);
	if ($mysqli->connect_errno) {
		exit;
	}
	
	$sql= 'SELECT 1 as enviado  '
	.'FROM env_seida_resultado e '
	.'WHERE e.hbl_code = "'.$hbl_code.'" and e.status = "1" ';
	if (!$resultado = $mysqli->query($sql)) {	
		//continuar;
	}
	else {
		if($resultado->num_rows>0){
			return "Manifiesto $hbl_code ya fue enviado a SUNAT";
		}
	}

	$sql= 'SELECT t1.id, t1.date, t1.hbl_code, t1.created_at, t1.place_receipt, '
	.'t1.vessel_name, t1.total_gross_weight_kgs, t1.total_cubic_cbm, t1.departure_date, t1.arrival_date, '
	.'t1.consignee_address, t1.consignee_city, '
	.'t1.shipper_address, t1.shipper_city, '
	.'t1.notify_address, t1.notify_city, '
	.'t1.proposito_documento_adicional,'    
	.'t1.codigo_empresa_software_adicional,'  
	.'t1.numero_referencial_adicional , ' 
	.'t1.aduana_proceso_adicional , ' 
	.'t1.referencia_emisor_adicional , '     
	.'t1.tipo_operador_adicional, '  
	.'t1.codigo_etapa_transporte_adicional, '	
	.'t1.documento_unico_escala_adicional , '  
	.'t1.nombre_responsable_adicional ,'      
	.'t1.ruc_operador_portuario_adicional, '  
	.'t1.tipo_lugar_descarga_adicional, '
	.'t1.tipo_lugar_llegada_adicional, '
	.'t1.tipo_medio_transporte,'
	.'t1.matricula_nave_adicional, '
	.'t1.codigo_tipo_manifiesto_adicional, '
	.'t1.codigo_aduana_adicional, '
    .'t1.tipo_documento_transporte_adicional, '
	.'t1.pais_origen_adicional, '
	.'t1.destinacion_carga_adicional, '
	.'t1.codigo_contrato_adicional, '
	.'t1.codigo_servicio_adicional, '
	.'t1.pais_origen_adicional, '
	.'t1.tipo_flete_adicional, '
	.'t1.tipo_pago_adicional, '
    .'op.name as ocean_port_name, '
	.'op.code as ocean_port_code, '
	.'cop.code as ocean_port_country_code, '
	.'sc.code as shipper_country_code, '
	.'cc.name as name_carrier, '
	.'"20100010136" as carrier_ruc_representante_adicional, '
	.'p1.code as code_port_inicio, '
	.'cp1.code as port_inicio_country_code, '
	.'p1.tipo_puerto_adicional as tipo_puerto_inicio, '
	.'p2.code as code_port_intermedio, '
	.'p2.tipo_puerto_adicional as tipo_puerto_intermedio, '
	.'ccn.identification_number as ruc_consignatario, '
	.'ccn.code as codigo_consignatario, '
	.'ccn.name as nombre_consignatario, '
	.'ccn.phone as telefono_consignatario, '
	.'ccn.fax as fax_consignatario, '
	.'ccn.email as email_consignatario, '
	.'cocn.code as codigo_pais_consignatario, '
	.'csf.identification_number as ruc_embarcador, '
	.'csf.code as codigo_embarcador, '
	.'csf.name as nombre_embarcador, '
	.'csf.phone as telefono_embarcador, '
	.'csf.fax as fax_embarcador, '
	.'csf.email as email_embarcador, '
	.'cosf.code as codigo_pais_embarcador, '	
	.'cni.identification_number as ruc_notificante, '
	.'cni.code as codigo_notificante, '
	.'cni.name as nombre_notificante, '
	.'cni.phone as telefono_notificante, '
	.'cni.fax as fax_notificante, '
	.'cni.email as email_notificante, '
	.'coni.code as codigo_pais_notificante '		
	.'FROM oi_bill_of_ladings t1  '
	.'LEFT JOIN mst_ocean_ports op on op.id = t1.port_unloading_id '
	.'LEFT JOIN mst_countries cop on cop.id = op.country_id '
	.'LEFT JOIN mst_countries sc on sc.id = t1.shipper_country_id '
	.'LEFT JOIN mst_carriers cc on cc.id = t1.carrier_id '
	.'LEFT JOIN mst_ocean_ports p1 on p1.id = t1.port_loading_id '
	.'LEFT JOIN mst_countries cp1 on cp1.id = p1.country_id '
	.'LEFT JOIN mst_ocean_ports p2 on p2.id = t1.transhipment_port_id '
	.'LEFT JOIN mst_customers ccn on ccn.id = t1.consignee_id '
	.'LEFT JOIN mst_countries cocn on cocn.id = ccn.country_id '
	.'LEFT JOIN mst_customers csf on csf.id = t1.shipper_id '
	.'LEFT JOIN mst_countries cosf on cosf.id = csf.country_id '
	.'LEFT JOIN mst_customers cni on cni.id = t1.notify_id '
	.'LEFT JOIN mst_countries coni on coni.id = cni.country_id '	
	.'WHERE t1.hbl_code = "'.$hbl_code.'"';



	if (!$resultado = $mysqli->query($sql)) {
		return "No se pudo Consultar el Manifiesto";
	}
	else {
		if($resultado->num_rows==0){
			return "No se encontró el Manifiesto";
		}
	}	
	$billlading = $resultado->fetch_assoc();
	var_dump($billlading);
	$billofladingDOM = new DOMDocument();
	$billofladingDOM->preserveWhiteSpace = false;
    $billofladingDOM->formatOutput = true;
	$billofladingDOM->loadXML(file_get_contents('billoflading.xml'));
	CabeceraFactura($billofladingDOM, $billlading, $infocode);
	$TaxableAmountIGV = 0;
	$TaxAmountIGV = 0;
	$TaxableAmount = 0;
	$TaxAmount = 0;
	$total_containers = 0;	
	$sql = "SELECT sum(d.gross_weight_kgs) as gross_weight_kgs , cd.container_number, cd.seal_number, cd.temperature, cd.container_max, cd.container_min, "
        ." cd.tara_contenedor_adicional, "      	    
        ." cd.tipo_equipamiento_adicional, "     
        ." cd.sub_tipo_equipamiento_adicional, " 
        ." cd.tipo_llenado_adicional, "          
        ." cd.tipo_movimiento_adicional, "       		
        ." cd.condicion_precinto_adicional, "    		
        ." cd.entidad_precinto_adicional, "      		
        ." cd.tipo_temperature_adicional "      		
	    ." FROM oi_bill_of_lading_cargo_details d, oi_bill_of_lading_container_details cd "
		." where cd.bill_of_lading_id = ".$billlading["id"]
		." and d.bill_of_lading_id = cd.bill_of_lading_id and d.line = cd.line order by d.line";

	/*if (!$resultado = $mysqli->query($sql)) {
	}*/
	
	
	$nid=1;
	print("#####################################################################################################\n");
	
	while ($detail = $resultado->fetch_assoc()) {
		var_dump( $detail);		
		$billofladingLineDOM = new DOMDocument();	
		$billofladingLineDOM->loadXML(file_get_contents('billofladingline.xml'));	
		$container_number                = $detail["container_number"];               
		$gross_weight_kgs                = $detail["gross_weight_kgs"];              
		$tara_contenedor_adicional       = $detail["tara_contenedor_adicional"];      
		$tipo_equipamiento_adicional     = $detail["tipo_equipamiento_adicional"];    
		$sub_tipo_equipamiento_adicional = $detail["sub_tipo_equipamiento_adicional"];
		$tipo_llenado_adicional          = $detail["tipo_llenado_adicional"];         
		$tipo_movimiento_adicional       = $detail["tipo_movimiento_adicional"];      
		$seal_number                     = $detail["seal_number"];                    
		$condicion_precinto_adicional    = $detail["condicion_precinto_adicional"];  
		$entidad_precinto_adicional      = $detail["entidad_precinto_adicional"];     
		$temperature                     = $detail["temperature"];                    
		$container_max                   = $detail["container_max"];                  
		$container_min                   = $detail["container_min"];
		if($container_number==""){
			$container_number="C0000001";
		}
		actualizarTagHijo($billofladingLineDOM, "TransportEquipment", "CharacteristicCode", $tipo_equipamiento_adicional);
		actualizarTagHijo($billofladingLineDOM, "TransportEquipment", "FullnessCode", $tipo_llenado_adicional);
		actualizarTagHijo($billofladingLineDOM, "TransportEquipment", "ID", $container_number);
		actualizarTagHijo($billofladingLineDOM, "TransportEquipment", "ActionCode", $sub_tipo_equipamiento_adicional);
		actualizarTagHijo($billofladingLineDOM, "GoodsMeasure", "eds:GrossMassMeasure", $gross_weight_kgs);
		//Precinto
		if($seal_number==""){
			$seal_number="S0000001";
		}		
		actualizarTagHijo($billofladingLineDOM, "Seal", "ID", $seal_number);
		actualizarTagHijo($billofladingLineDOM, "Seal", "ConditionCode", $condicion_precinto_adicional);
		actualizarTagHijo($billofladingLineDOM, "SealingParty", "TypeCode", $entidad_precinto_adicional);
		
		actualizarTagHijo($billofladingLineDOM, "TransportEquipmentMeasure", "eds:TareWeightMeasure", $tara_contenedor_adicional);
	
     	print($billofladingLineDOM->saveXML()."\n");
		$nid++;
		$billofladingDOM->getElementsByTagName("BorderTransportMeans")->item(0)->appendChild($billofladingDOM->importNode($billofladingLineDOM->documentElement, TRUE));
		$total_containers++;
		print("#########################################################\n");
	}

	actualizarTagHijo($billofladingDOM, "BorderTransportMeans", "TransportEquipmentQuantity", $total_containers);
	
    //Cantidad de equipamientos
    $StatementTypeCode = "AGX";

	$nododocument = $billofladingDOM->createElement("AdditionalInformation");

	$nodoContent = $billofladingDOM->createElement("Content", $total_containers);
	$nodoStatementTypeCode = $billofladingDOM->createElement("StatementTypeCode",$StatementTypeCode);
	
	$nododocument->appendChild($nodoContent);
	$nododocument->appendChild($nodoStatementTypeCode);

    agregarNodoAntes($billofladingDOM, "Consignor", $nododocument);	

    //Indicador de Documento de Transporte
    $StatementTypeCode = "BLC";

	$nododocument = $billofladingDOM->createElement("AdditionalInformation");

	$nodoContent = $billofladingDOM->createElement("Content", "1");
	$nodoStatementTypeCode = $billofladingDOM->createElement("StatementTypeCode",$StatementTypeCode);
	
	$nododocument->appendChild($nodoContent);
	$nododocument->appendChild($nodoStatementTypeCode);

    agregarNodoAntes($billofladingDOM, "Consignor", $nododocument);
	
	$sql = "SELECT d.gross_weight_kgs as peso_bruto_mercancia, cd.container_number as contenedor_asociado, d.pieces as cantidad_bultos, "
	    ."d.cubic_cbm as volumen_mercancia, "
	    ."d.description as descripcion_mercancia, "
	    ."sum(chd.billing_amount) as valor_aduanas, "
		."sum(case when chd.billing_id = 641 then chd.billing_amount else 0 end) as valor_flete, "
        ." d.condicion_carga_adicional, "      	    
        ." d.codigo_naturaleza_adicional, "     
        ." d.partida_arancelaria_adicional, " 
		." d.tipo_de_bultos_adicional, " 
		." d.marcas_numeros_adicional "
	    ." FROM oi_bill_of_lading_cargo_details d, oi_bill_of_lading_container_details cd, oi_bill_of_lading_charge_details chd  "
		." where cd.bill_of_lading_id = ".$billlading["id"]. " and d.pieces > 0 "
		." and d.bill_of_lading_id = cd.bill_of_lading_id and d.line = cd.line "
		." and d.bill_of_lading_id = chd.bill_of_lading_id and d.line = chd.line order by d.line";

    echo '<hr>';
    echo $sql;


	if (!$resultado = $mysqli->query($sql)) {
	}
	$nid=1;
	$total_bultos = 0;
	$total_valor_flete=0;
	
	print("#####################################################################################################\n");
	while ($detail = $resultado->fetch_assoc()) {
		var_dump( $detail);		
		$billofladingDetailDOM = new DOMDocument();	
		$billofladingDetailDOM->loadXML(file_get_contents('billofladingdetail.xml'));
		$peso_bruto_mercancia            = $detail["peso_bruto_mercancia"];      
        $contenedor_asociado             = $detail["contenedor_asociado"];   		
		$volumen_mercancia               = $detail["volumen_mercancia"];              
		$valor_aduanas                   = $detail["valor_aduanas"];      
		$valor_flete                     = $detail["valor_flete"]; 
		$descripcion_mercancia           = $detail["descripcion_mercancia"];    
		$sub_tipo_equipamiento_adicional = $detail["valor_aduanas"];
		$condicion_carga_adicional       = $detail["condicion_carga_adicional"];         
		$codigo_naturaleza_adicional     = $detail["codigo_naturaleza_adicional"];      
		$partida_arancelaria_adicional   = $detail["partida_arancelaria_adicional"];		
		$marcas_numeros_adicional        = $detail["marcas_numeros_adicional"];
		$cantidad_bultos                 = $detail["cantidad_bultos"];
		$tipo_de_bultos_adicional        = $detail["tipo_de_bultos_adicional"];
		$incoterm_valor_aduanas          = "FOB";
		actualizarTag($billofladingDetailDOM, "SequenceNumeric", $nid);
		actualizarTag($billofladingDetailDOM, "GoodsStatusCode", $condicion_carga_adicional);
		actualizarTag($billofladingDetailDOM, "Description", $descripcion_mercancia);
		actualizarTag($billofladingDetailDOM, "ValueAmount", $valor_aduanas);
		actualizarTag($billofladingDetailDOM, "CategoryQualifierCode", $codigo_naturaleza_adicional);
		actualizarTagHijo($billofladingDetailDOM, "Classification", "ID", $partida_arancelaria_adicional);		
		actualizarTagHijoSub($billofladingDetailDOM, "ConsignmentItem", "Freight","PaymentMethodCode", $incoterm_valor_aduanas);
		actualizarTag($billofladingDetailDOM, "GrossMassMeasure", $peso_bruto_mercancia);
		actualizarTag($billofladingDetailDOM, "NetVolumeMeasure", $volumen_mercancia);
		if($contenedor_asociado==""){
			$contenedor_asociado="C000001";
		}
        actualizarTagHijo($billofladingDetailDOM, "Packaging", "MarksNumbersID", $marcas_numeros_adicional);
        actualizarTagHijo($billofladingDetailDOM, "Packaging", "QuantityQuantity", round($cantidad_bultos,0));
        actualizarTagHijo($billofladingDetailDOM, "Packaging", "TypeCode", $tipo_de_bultos_adicional);		
		actualizarTagHijo($billofladingDetailDOM, "TransportEquipment", "ID", $contenedor_asociado);		
		agregarNodoAntes($billofladingDOM, "Consignor", $billofladingDOM->importNode($billofladingDOM->importNode($billofladingDetailDOM->documentElement, TRUE)));		
		print($billofladingDetailDOM->saveXML()."\n");		
		$total_bultos += $cantidad_bultos;
		$total_valor_flete+=$valor_flete;
		print("#########################################################$total_valor_flete\n");
		$nid++;	
	}
	actualizarTagHijoSub($billofladingDOM, "Declaration", "Packaging", "QuantityQuantity", $total_bultos);	
	$tipo_pago =  "PP";
	$tipo_flete =  "100000";
	actualizarTagHijoSub($billofladingDOM, "Consignment", "Freight", "PaymentMethodCode", $tipo_pago);
	actualizarTagHijoSub($billofladingDOM, "Consignment", "Freight", "RateTypeCode", $tipo_flete);
	actualizarTagHijoSub($billofladingDOM, "Consignment", "Freight", "RateAmount", $total_valor_flete);
	actualizarTagHijo($billofladingDOM, "Consignment", "SequenceNumeric", "1");
	actualizarTagHijo($billofladingDOM, "Consignment", "TotalPackageQuantity", $total_bultos);	
	$resultado = envio_seida($mysqli, $billlading["id"], $billlading, $infocode, $hbl_code, $billofladingDOM->saveXML());
	return $resultado;
}

$hbl_code = "F2020-01489-VP";
$infocode = "0101";
$salida = enviar_bill_lading($infocode, $hbl_code,true);
var_dump($salida);



?>