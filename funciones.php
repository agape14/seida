<?php
require_once 'constantes.php';
require "xmlsecg/xmlseclibs.php";

use Greenter\XMLSecLibs\Sunat\SignedXml;

function CabeceraFactura(&$billofladingDOM, $billoflading, $codigo_trx){
	
	global $ruc;
	
	$_customization_id = "1.0";  
	$_issue_date =  $billoflading['date'];
	$_issue_time = "00:00:00";
	$_version_id = "1.0";
	$_billoflading_type_code ='01'; 
	$_document_currency_code = 'PEN'; 
	$_ruc_veco = $ruc;
	$_veco_name = '<![CDATA[VECO LOGISTICS PERU S.A.C.]]>';
	$_veco_name = 'VECO LOGISTICS PERU S.A.C.';
	$_identification_code = '<![CDATA[PE]]>';
	$_street_name = '<![CDATA[CALLE CURA MUÑECAS  No. 187 OF.302 - SAN ISIDRO - LIMA]]>';
	$_codigo_ubigeo ='150131';
	
	$_veco_urbanization_CitySubdivisionName = ''; 
	$_veco_province_cityname = '';
	$_veco_departamento_countrysubentity = '';
	$_veco_distrito_district = '';
	$_client_document_type='6';
	$_ID = $billoflading["id"];
	$_tipo_manifiesto = "01";

    //Cabeceras

	$created_at =formatFecha204($billoflading['created_at']);

	$aduana_proceso_adicional          = $billoflading['aduana_proceso_adicional']; 
	$proposito_documento_adicional     = $billoflading['proposito_documento_adicional'];     
	$codigo_empresa_software_adicional = $billoflading['codigo_empresa_software_adicional'];
	$numero_referencial_adicional      = $billoflading['numero_referencial_adicional'];
	$referencia_emisor_adicional       = $billoflading['referencia_emisor_adicional'];
	$tipo_operador_adicional           = $billoflading['tipo_operador_adicional'];
    actualizarTag($billofladingDOM, "FunctionalDefinition",$codigo_trx);
	actualizarTag($billofladingDOM, "FunctionCode", $codigo_trx);
	actualizarTag($billofladingDOM, "FunctionalReferenceID", $numero_referencial_adicional);
	actualizarTagHijo($billofladingDOM, "IssueDateTime", "ds:DateTimeString", $created_at);
	actualizarTag($billofladingDOM, "VersionID", $_version_id);
	
	actualizarTagHijo($billofladingDOM, "Submitter", "ID", $_ruc_veco);
	actualizarTagHijo($billofladingDOM, "Submitter", "RoleCode", $tipo_operador_adicional);
	actualizarTagHijo($billofladingDOM, "Contact", "Name", $codigo_empresa_software_adicional);
	actualizarTagHijo($billofladingDOM, "Contact", "FunctionCode", $codigo_empresa_software_adicional);

    actualizarTagHijo($billofladingDOM, "DeclarationOffice", "ID", $aduana_proceso_adicional);
	
	
	$codigo_aduana_adicional           = $billoflading['codigo_aduana_adicional'];
	$documento_unico_escala_adicional  = $billoflading['documento_unico_escala_adicional'];  

	
	$nododocument = $billofladingDOM->createElement("AdditionalDocument");
	$nodocategoria = $billofladingDOM->createElement("CategoryCode", $_tipo_manifiesto);
	
	$nodoIssueDateTime = $billofladingDOM->createElement("IssueDateTime");
	$nododatetime = $billofladingDOM->createElement("ds:DateTimeString", );
	$nododatetimeattr = $billofladingDOM->createAttribute('formatCode');
	$nododatetimeattr->value = "602";
	$nododatetime->appendChild($nododatetimeattr);
    $nodoIssueDateTime->appendChild($nododatetime);

	$nodolocacion = $billofladingDOM->createElement("issueLocationID", $codigo_aduana_adicional);
	
	$nodoTypeCode = $billofladingDOM->createElement("TypeCode","785");
	
	$nododocument->appendChild($nodocategoria);
	$nododocument->appendChild($nodoIssueDateTime);
	$nododocument->appendChild($nodolocacion);
	$nododocument->appendChild($nodoTypeCode);

    agregarNodoAntes($billofladingDOM, "BorderTransportMeans", $nododocument);
	
	$nododocument = $billofladingDOM->createElement("AdditionalDocument");

	$nodoID = $billofladingDOM->createElement("ID", $documento_unico_escala_adicional);
	$nodoTypeCode = $billofladingDOM->createElement("TypeCode","187");
	
	$nododocument->appendChild($nodoID);
	$nododocument->appendChild($nodoTypeCode);

    agregarNodoAntes($billofladingDOM, "BorderTransportMeans", $nododocument);	
	

	//$place_receipt = $billoflading['place_receipt'];
	$vessel_name = $billoflading['vessel_name'];

	
	$tipo_medio_transporte = $billoflading['tipo_medio_transporte'];	
	$matricula_nave_adicional = $billoflading['matricula_nave_adicional'];	
	
    $shipper_country_code = $billoflading['shipper_country_code'];
	$name_carrier = $billoflading['name_carrier'];
			
	$entidad_matricula = "54";
	$via_transporte = "1";
	
	$total_gross_weight_kgs = $billoflading['total_gross_weight_kgs'];	
	
	actualizarTagHijo($billofladingDOM, "BorderTransportMeans","Name", $vessel_name);		
	actualizarTagHijo($billofladingDOM, "BorderTransportMeans","ID", $matricula_nave_adicional);		
	actualizarTagHijo($billofladingDOM, "BorderTransportMeans","IdentificationTypeCode", $entidad_matricula);
	actualizarTagHijo($billofladingDOM, "BorderTransportMeans","TypeCode", $tipo_medio_transporte);
	
	actualizarTagHijo($billofladingDOM, "BorderTransportMeans","RegistrationNationalityCode", $shipper_country_code);
	actualizarTagHijo($billofladingDOM, "BorderTransportMeans","ModeCode", $via_transporte);
	
	
	$arrival_date = formatFecha204($billoflading['arrival_date']);
	
	actualizarTagHijo($billofladingDOM, "ArrivalDateTime","ds:DateTimeString", $arrival_date);
	actualizarTagHijo($billofladingDOM, "BorderTransportMeans", "GrossWeightMeasure", $total_gross_weight_kgs);		


	$hbl_code = $billoflading['hbl_code'];
	
	$codigo_etapa_transporte_adicional = $billoflading['codigo_etapa_transporte_adicional'];  
	$nombre_responsable_adicional      = $billoflading['nombre_responsable_adicional'];      
	$ruc_operador_portuario_adicional  = $billoflading['ruc_operador_portuario_adicional'];  
	$tipo_lugar_descarga_adicional     = $billoflading['tipo_lugar_descarga_adicional'];      

	$ocean_port_code                   = $billoflading['ocean_port_code'];
	$ocean_port_country_code           = $billoflading['ocean_port_country_code'];
	
	$ocean_port_name = $billoflading['ocean_port_name'];
	
	$tipo_lugar_llegada_adicional      = $billoflading['tipo_lugar_llegada_adicional']; 

	actualizarTagHijo($billofladingDOM, "BorderTransportMeans", "JourneyID", $hbl_code);    

    actualizarTagHijo($billofladingDOM, "ArrivalLocation", "ID", $ocean_port_country_code.$ocean_port_code);  
	actualizarTagHijoSub($billofladingDOM, "ArrivalLocation", "Warehouse", "TypeCode", $tipo_lugar_llegada_adicional);    
	
	//Itinerario
   
	$departure_date         =  formatFecha204($billoflading['departure_date']);
	$code_port_inicio         = $billoflading['code_port_inicio'];
	$port_inicio_country_code   = $billoflading['port_inicio_country_code'];
	
	$tipo_puerto_inicio     = $billoflading['tipo_puerto_inicio'];
	
	
	actualizarTagHijo($billofladingDOM, "Itinerary", "ID", $code_port_inicio);   
	actualizarTagHijo($billofladingDOM, "Itinerary", "SequenceNumeric", "1");   
	actualizarTagHijo($billofladingDOM, "DepartureDateTime", "ds:DateTimeString", $departure_date);   
	actualizarTagHijo($billofladingDOM, "Itinerary", "FunctionCode", $tipo_puerto_inicio);   
	
	actualizarTagHijo($billofladingDOM, "Master", "Name", $nombre_responsable_adicional);   
	
    if($name_carrier=="") $name_carrier="CARRIER DUMMY";
	//Identificacion Transportista
	$carrier_ruc_representante_adicional = $billoflading['carrier_ruc_representante_adicional'];
	$carrier_tipo_representante = "12";
	
	actualizarTagHijo($billofladingDOM, "Carrier","Name",     $name_carrier);
	actualizarTagHijo($billofladingDOM, "Carrier","ID",       $carrier_ruc_representante_adicional);
	actualizarTagHijo($billofladingDOM, "Carrier","RoleCode", $carrier_tipo_representante);
	
	$pais_origen_adicional       = $billoflading['pais_origen_adicional'];  	
	
	$nodoGoodsLocation = $billofladingDOM->createElement("GoodsLocation");
	
	$nodoID = $billofladingDOM->createElement("ID", $pais_origen_adicional);
	$nodoTypeCode = $billofladingDOM->createElement("TypeCode","27");
	
	$nodoGoodsLocation->appendChild($nodoID);
	$nodoGoodsLocation->appendChild($nodoTypeCode);

    agregarNodoAntes($billofladingDOM, "GovernmentProcedure", $nodoGoodsLocation);		
	
	$nodoGoodsLocation = $billofladingDOM->createElement("GoodsLocation");
	
	$nodoID = $billofladingDOM->createElement("ID", $ocean_port_country_code.$ocean_port_code);
	$nodoTypeCode = $billofladingDOM->createElement("TypeCode","8");
	
	$nodoGoodsLocation->appendChild($nodoID);
	$nodoGoodsLocation->appendChild($nodoTypeCode);

    agregarNodoAntes($billofladingDOM, "GovernmentProcedure", $nodoGoodsLocation);			

    //<!-- Fecha de emisión del documento de transporte--
    $tipo_fecha_emision = 705;

	$nododocument = $billofladingDOM->createElement("AdditionalDocument");

	$nodoIssueDateTime = $billofladingDOM->createElement("IssueDateTime");
	$nododatetime = $billofladingDOM->createElement("ds:DateTimeString", $created_at);
	$nododatetimeattr = $billofladingDOM->createAttribute('formatCode');
	$nododatetimeattr->value = "204";
	$nododatetime->appendChild($nododatetimeattr);
    $nodoIssueDateTime->appendChild($nododatetime);

	$nodoTypeCode = $billofladingDOM->createElement("TypeCode",$tipo_fecha_emision);
	
	$nododocument->appendChild($nodoIssueDateTime);
	$nododocument->appendChild($nodoTypeCode);

    agregarNodoAntes($billofladingDOM, "Consignor", $nododocument);

	$total_cubic_cbm  = $billoflading['total_cubic_cbm'];
	actualizarTagHijo($billofladingDOM, "Consignment", "GrossVolumeMeasure", $total_cubic_cbm);
	actualizarTagHijo($billofladingDOM, "Consignment", "TotalGrossMassMeasure", $total_gross_weight_kgs);
	
	//Consignatario
	$ruc_consignatario                = $billoflading['ruc_consignatario'];
	$codigo_consignatario             = $billoflading['ruc_consignatario'];
	$nombre_consignatario             = $billoflading['nombre_consignatario'];
    $rol_consignatario                = "SF";
	$direccion_consignatario          = $billoflading['consignee_address'];
	$ciudad_consignatario             = $billoflading['consignee_city'];
	$codigo_pais_consignatario        = $billoflading['codigo_pais_consignatario'];
	$telefono_consignatario           = $billoflading['telefono_consignatario'];
	$fax_consignatario                = $billoflading['fax_consignatario'];
	$email_consignatario              = $billoflading['email_consignatario'];
	
	actualizarTagHijo($billofladingDOM, "Consignor","Name", $nombre_consignatario);
	actualizarTagHijo($billofladingDOM, "Consignor","ID", $ruc_consignatario);
	actualizarTagHijo($billofladingDOM, "Consignor","RoleCode", $rol_consignatario);
	actualizarTagHijoSub($billofladingDOM, "Consignor", "Address", "Line", $direccion_consignatario);
	actualizarTagHijoSub($billofladingDOM, "Consignor", "Address", "CityName", $ciudad_consignatario);
	actualizarTagHijoSub($billofladingDOM, "Consignor", "Address", "CountryCode", $codigo_pais_consignatario);
	actualizarTagHijo($billofladingDOM, "LoadingLocation", "ID", $port_inicio_country_code.$code_port_inicio);
	actualizarTagHijoSub($billofladingDOM, "LoadingLocation", "ArrivalDateTime", "ds:DateTimeString", $departure_date);

    //Documento de Transporte
	$tipo_documento_transporte_adicional =  $billoflading['tipo_documento_transporte_adicional'];
	$tipo_identificacion_responsable = "12"; 	
	actualizarTagHijo($billofladingDOM, "TransportContractDocument", "ID", $hbl_code);
	actualizarTagHijo($billofladingDOM, "TransportContractDocument", "IssuingPartyID", $tipo_identificacion_responsable);
	actualizarTagHijo($billofladingDOM, "TransportContractDocument", "TypeCode", $tipo_documento_transporte_adicional);
	actualizarTagHijoSub($billofladingDOM, "TransportContractDocument","Submitter", "ID", $_ruc_veco);
	actualizarTagHijo($billofladingDOM, "UnloadingLocation", "ID", $ocean_port_country_code.$ocean_port_code);	
	actualizarTagHijo($billofladingDOM, "TransportContractDocument", "IssueLocationName", $ocean_port_country_code.$ocean_port_code);	
	$destinacion_carga_adicional = $billoflading['destinacion_carga_adicional'];
	$codigo_contrato_adicional   = $billoflading['codigo_contrato_adicional'];  
	$codigo_servicio_adicional   = $billoflading['codigo_servicio_adicional'];  
	$tipo_flete_adicional        = $billoflading['tipo_flete_adicional'];       
	$tipo_pago_adicional         = $billoflading['tipo_pago_adicional'];
	actualizarTagHijo($billofladingDOM, "GovernmentProcedure", "CurrentCode", $destinacion_carga_adicional);
} 

function obtenerRespuestaXML($response){	
	$cadena = (string)$response->getBody();	
		$xmlDoc = new DOMDocument();
		$xmlDoc->loadXML($cadena);		
		$response = $xmlDoc->getElementsByTagName('recibirArchivoResultado');	
		$xml = Dom2Array($response->item(0));
		return $xml;
}

function convertir(){	
	$xml='';
		$xmlDoc = new DOMDocument();
		$xmlDoc->loadXML($xml);		
		$xml = Dom2Array($xmlDoc->documentElement);
	var_dump($xml);
}

function Dom2Array($root) {
    $array = array();
    if($root->nodeType == XML_ELEMENT_NODE) {
        if($root->hasChildNodes()) {
            $children = $root->childNodes;
			if($children->length>1){
				for($i = 0; $i < $children->length; $i++) {
					$child = Dom2Array( $children->item($i) );
					if(!empty($child)) {
						$array[$root->nodeName][] = $child;
					}
				}
			}
			elseif($children->length==1){
				$child = Dom2Array( $children->item(0));
                if(!empty($child)) {
                    $array[$root->nodeName] = $child;
                }
			}
        }
    } 
	elseif($root->nodeType == XML_TEXT_NODE || $root->nodeType == XML_CDATA_SECTION_NODE) {
        $value = trim($root->nodeValue);
        if(!empty($value)) {
            $array = $value;
        }
    }
    return $array;
}

function agregarTag($xmlDoc, $padre, $tag, $valor){
	$xmlDoc->getElementsByTagName($padre)->item(0)->appendChild($xmlDoc->createElement($tag,$valor));
}

function agregarTagHijo($xmlDoc, $padre, $hijo, $tag, $valor){
	$nodohijo = $xmlDoc->createElement($hijo);
	$nodotexto = $xmlDoc->createElement($tag, $valor);
	$nodohijo->appendChild($nodotexto);	
	$xmlDoc->getElementsByTagName($padre)->item(0)->appendChild($nodohijo);
}

function agregarTagHijoDoble($xmlDoc, $padre, $hijo, $subtag, $tag, $valor){
	$nodohijo = $xmlDoc->createElement($hijo);
	$nodosubtag = $xmlDoc->createElement($subtag);
	$nodotexto = $xmlDoc->createElement($tag, $valor);
	$nodohijo->appendChild($nodosubtag);
	$nodosubtag->appendChild($nodotexto);	
	$xmlDoc->getElementsByTagName($padre)->item(0)->appendChild($nodohijo);
}

function agregarTagHijoSub($xmlDoc, $padre, $hijo, $tag, $valor){
	$nodotexto = $xmlDoc->createElement($tag, $valor);
	$nodopadre = $xmlDoc->getElementsByTagName($padre)->item(0);
	foreach ($nodopadre->childNodes as $nodoHijo){		
		if($nodoHijo->nodeName == $hijo){
			$nodoHijo->appendChild($nodotexto);
		}		
   }
	
}

function agregarItinerarioTag($xmlDoc,  $secuencia, $fechapartida, $lugar, $tipo ){

	$nodoruta = $xmlDoc->createElement("ram:ItineraryTransportRoute");
	$nodoevento = $xmlDoc->createElement("ram:ItineraryStopTransportEvent");
	
	$nodolocacion = $xmlDoc->createElement("ram:OccurrenceLogisticsLocation");

	$nodotextoID = $xmlDoc->createElement("ram:ID", $secuencia);

	$nodotextoDeparture = $xmlDoc->createElement("ram:DepartureRelatedDateTime", $fechapartida);
	
	$nodotextoLocacionID = $xmlDoc->createElement("ram:ID", $lugar);
	$nodotextoLocacionTipo = $xmlDoc->createElement("ram:TypeCode", $tipo);
	
	$nodolocacion->appendChild($nodotextoLocacionID);
	$nodolocacion->appendChild($nodotextoLocacionTipo);
	
	$nodoevento->appendChild($nodotextoID);
	$nodoevento->appendChild($nodotextoDeparture);
	$nodoevento->appendChild($nodolocacion);
	
	$nodoruta->appendChild($nodoevento);
	$nodopadre = $xmlDoc->getElementsByTagName("LogisticsTransportMovement")->item(0);

	$nodopadre->appendChild($nodoruta);
	
}


function agregarTagAntes($xmlDoc, $anterior, $tag, $valor){

	$nodoant=$xmlDoc->getElementsByTagName($anterior)->item(0);
	$nodotop=$xmlDoc->documentElement;
	
	$nodotexto = $xmlDoc->createElement($tag, $valor);
	$nodotop->insertBefore($nodotexto, $nodoant);

}


function agregarNodoAntes($xmlDoc, $nodosiguiente, $nodoanterior){

	$nodoant=$xmlDoc->getElementsByTagName($nodosiguiente)->item(0);
	$nodotop=$xmlDoc->documentElement;
print($nodoanterior->nodeName."\n");
$nodoant->parentNode->insertBefore($nodoanterior, $nodoant);
}


function actualizarTag($xmlDoc, $tag, $valor){
	$xmlDoc->getElementsByTagName($tag)->item(0)->nodeValue=$valor;
}

function actualizarTagHijo($xmlDoc, $padre, $hijo, $valor){
	$nodopadre = $xmlDoc->getElementsByTagName($padre)->item(0);
	foreach ($nodopadre->childNodes as $nodoHijo){
		if($nodoHijo->nodeName == $hijo){
			$nodoHijo->nodeValue = $valor;
		}
   }
}

function actualizarTagHijoSub($xmlDoc, $padre, $hijo, $subtag, $valor){
	$nodopadre = $xmlDoc->getElementsByTagName($padre)->item(0);
	foreach ($nodopadre->childNodes as $nodoHijo){
		if($nodoHijo->nodeName == $hijo){
			foreach ($nodoHijo->childNodes as $nodoSub){
				if($nodoSub->nodeName == $subtag){
					$nodoSub->nodeValue = $valor;
				}
			}
		}
   }
}


function obtenerXMLEnvelope($archivozip, $base64){
	global $envelope, $ruc, $username, $password, $macaddress, $ipaddress;
	
	$xmlDocum = new DOMDocument();
	$xmlDocum->loadXML($envelope);	
	actualizarTagHijo($xmlDocum, "UsernameToken","wsse:Username", $ruc.$username."|".$macaddress."|".$ipaddress);
	actualizarTagHijo($xmlDocum, "UsernameToken", "wsse:Password", $password);
	actualizarTagHijo($xmlDocum, "recibirArchivo", "numeroTransaccion", $archivozip);
	actualizarTagHijo($xmlDocum, "recibirArchivo", "informacionArchivo", $base64);
	return $xmlDocum->saveXML();

}

function firmarXMLBase64($infocode, $billoflading){
	
	$xmlPath = $billoflading.'.xml';
    //$certPath = 'certifcate.pem'; 
	
	unlink($infocode.'.zip');
	
	//$signer = new SignedXml();
	//$signer->setCertificateFromFile($certPath);
	
	//$xmlSigned = $signer->signFromFile($xmlPath);
	
	//file_put_contents($factura."signed.xml", $xmlSigned);
	
	//printf("xmlPath  --".$xmlPath."--\n");
	
	$zip = new ZipArchive;
	if ($zip->open($infocode.'.zip', ZipArchive::CREATE) === TRUE){
		$zip->addFile($xmlPath, $xmlPath);
		$zip->close();
	}
	
	return base64_encode(file_get_contents($infocode.'.zip'));
	
}

function unidad($numuero){
	switch ($numuero){
		case 9:{
			$numu = "NUEVE";
			break;
		}
		case 8:{
			$numu = "OCHO";
			break;
		}
		case 7:{
			$numu = "SIETE";
			break;
		}
		case 6:{
			$numu = "SEIS";
			break;
		}
		case 5:{
			$numu = "CINCO";
			break;
		}
		case 4:{
			$numu = "CUATRO";
			break;
		}
		case 3:{
			$numu = "TRES";
			break;
		}
		case 2:{
			$numu = "DOS";
			break;
		}
		case 1:{
			$numu = "UNO";
			break;
		}
		case 0:{
			$numu = "";
			break;
		}
	}
	return $numu;
}

function decena($numdero){
	if ($numdero >= 90 && $numdero <= 99){
		$numd = "NOVENTA ";
		if ($numdero > 90)
			$numd = $numd."Y ".(unidad($numdero - 90));
	}
	else if ($numdero >= 80 && $numdero <= 89)	{
		$numd = "OCHENTA ";
		if ($numdero > 80)
			$numd = $numd."Y ".(unidad($numdero - 80));
	}
	else if ($numdero >= 70 && $numdero <= 79)	{
		$numd = "SETENTA ";
		if ($numdero > 70)
			$numd = $numd."Y ".(unidad($numdero - 70));
	}
	else if ($numdero >= 60 && $numdero <= 69)	{
	$numd = "SESENTA ";
	if ($numdero > 60)
	$numd = $numd."Y ".(unidad($numdero - 60));
	}
	else if ($numdero >= 50 && $numdero <= 59)	{
	$numd = "CINCUENTA ";
	if ($numdero > 50)
	$numd = $numd."Y ".(unidad($numdero - 50));
	}
	else if ($numdero >= 40 && $numdero <= 49)	{
	$numd = "CUARENTA ";
	if ($numdero > 40)
	$numd = $numd."Y ".(unidad($numdero - 40));
	}
	else if ($numdero >= 30 && $numdero <= 39)	{
	$numd = "TREINTA ";
	if ($numdero > 30)
	$numd = $numd."Y ".(unidad($numdero - 30));
	}
	else if ($numdero >= 20 && $numdero <= 29)	{
	if ($numdero == 20)
	$numd = "VEINTE ";
	else
	$numd = "VEINTI".(unidad($numdero - 20));
	}
	else if ($numdero >= 10 && $numdero <= 19)	{
	switch ($numdero){
	case 10:	{
	$numd = "DIEZ ";
	break;
	}
	case 11:	{
	$numd = "ONCE ";
	break;
	}
	case 12:	{
	$numd = "DOCE ";
	break;
	}
	case 13:	{
	$numd = "TRECE ";
	break;
	}
	case 14:	{
	$numd = "CATORCE ";
	break;
	}
	case 15:	{
	$numd = "QUINCE ";
	break;
	}
	case 16:	{
	$numd = "DIECISEIS ";
	break;
	}
	case 17:	{
	$numd = "DIECISIETE ";
	break;
	}
	case 18:	{
	$numd = "DIECIOCHO ";
	break;
	}
	case 19:	{
	$numd = "DIECINUEVE ";
	break;
	}
	}
	}
	else
		$numd = unidad($numdero);
	return $numd;
}

function centena($numc){
	if ($numc >= 100)
	{
	if ($numc >= 900 && $numc <= 999)	{
	$numce = "NOVECIENTOS ";
	if ($numc > 900)
		$numce = $numce.(decena($numc - 900));
	}
	else if ($numc >= 800 && $numc <= 899)	{
	$numce = "OCHOCIENTOS ";
	if ($numc > 800)
	$numce = $numce.(decena($numc - 800));
	}
	else if ($numc >= 700 && $numc <= 799)	{
	$numce = "SETECIENTOS ";
	if ($numc > 700)
	$numce = $numce.(decena($numc - 700));
	}
	else if ($numc >= 600 && $numc <= 699)	{
	$numce = "SEISCIENTOS ";
	if ($numc > 600)
	$numce = $numce.(decena($numc - 600));
	}
	else if ($numc >= 500 && $numc <= 599)	{
	$numce = "QUINIENTOS ";
	if ($numc > 500)
	$numce = $numce.(decena($numc - 500));
	}
	else if ($numc >= 400 && $numc <= 499)	{
	$numce = "CUATROCIENTOS ";
	if ($numc > 400)
	$numce = $numce.(decena($numc - 400));
	}
	else if ($numc >= 300 && $numc <= 399)	{
	$numce = "TRESCIENTOS ";
	if ($numc > 300)
	$numce = $numce.(decena($numc - 300));
	}
	else if ($numc >= 200 && $numc <= 299)	{
	$numce = "DOSCIENTOS ";
	if ($numc > 200)
	$numce = $numce.(decena($numc - 200));
	}
	else if ($numc >= 100 && $numc <= 199)	{
	if ($numc == 100)
		$numce = "CIEN ";
	else
	$numce = "CIENTO ".(decena($numc - 100));
	}
	}
	else
	$numce = decena($numc);
	
	return $numce;
}

function miles($nummero){
	if ($nummero >= 1000 && $nummero < 2000){
	$numm = "MIL ".(centena($nummero%1000));
	}
	if ($nummero >= 2000 && $nummero <10000){
	$numm = unidad(Floor($nummero/1000))." MIL ".(centena($nummero%1000));
	}
	if ($nummero < 1000)
	$numm = centena($nummero);
	
	return $numm;
}

function decmiles($numdmero){
	if ($numdmero == 10000)
	$numde = "DIEZ MIL";
	if ($numdmero > 10000 && $numdmero <20000){
	$numde = decena(Floor($numdmero/1000))."MIL ".(centena($numdmero%1000));
	}
	if ($numdmero >= 20000 && $numdmero <100000){
	$numde = decena(Floor($numdmero/1000))." MIL ".(miles($numdmero%1000));
	}
	if ($numdmero < 10000)
	$numde = miles($numdmero);
	
	return $numde;
}

function cienmiles($numcmero){
	if ($numcmero == 100000)
	$num_letracm = "CIEN MIL";
	if ($numcmero >= 100000 && $numcmero <1000000){
	$num_letracm = centena(Floor($numcmero/1000))." MIL ".(centena($numcmero%1000));
	}
	if ($numcmero < 100000)
	$num_letracm = decmiles($numcmero);
	return $num_letracm;
}

function millon($nummiero){
	if ($nummiero >= 1000000 && $nummiero <2000000){
	$num_letramm = "UN MILLON ".(cienmiles($nummiero%1000000));
	}
	if ($nummiero >= 2000000 && $nummiero <10000000){
	$num_letramm = unidad(Floor($nummiero/1000000))." MILLONES ".(cienmiles($nummiero%1000000));
	}
	if ($nummiero < 1000000)
	$num_letramm = cienmiles($nummiero);
	
	return $num_letramm;
}

function decmillon($numerodm){
	if ($numerodm == 10000000)
	$num_letradmm = "DIEZ MILLONES";
	if ($numerodm > 10000000 && $numerodm <20000000){
	$num_letradmm = decena(Floor($numerodm/1000000))."MILLONES ".(cienmiles($numerodm%1000000));
	}
	if ($numerodm >= 20000000 && $numerodm <100000000){
	$num_letradmm = decena(Floor($numerodm/1000000))." MILLONES ".(millon($numerodm%1000000));
	}
	if ($numerodm < 10000000)
	$num_letradmm = millon($numerodm);
	
	return $num_letradmm;
}

function cienmillon($numcmeros){
	if ($numcmeros == 100000000)
	$num_letracms = "CIEN MILLONES";
	if ($numcmeros >= 100000000 && $numcmeros <1000000000){
		$num_letracms = centena(Floor($numcmeros/1000000))." MILLONES ".(millon($numcmeros%1000000));
	}
	if ($numcmeros < 100000000)
	$num_letracms = decmillon($numcmeros);
	return $num_letracms;
}

function milmillon($nummierod){
	if ($nummierod >= 1000000000 && $nummierod <2000000000){
		$num_letrammd = "MIL ".(cienmillon($nummierod%1000000000));
	}
	if ($nummierod >= 2000000000 && $nummierod <10000000000){
		$num_letrammd = unidad(Floor($nummierod/1000000000))." MIL ".(cienmillon($nummierod%1000000000));
	}
	if ($nummierod < 1000000000)
		$num_letrammd = cienmillon($nummierod);
	
	return $num_letrammd;
}

function convertirletras($numero){
	$num = str_replace(",","",$numero);
	$num = number_format($num,2,'.','');
	$cents = substr($num,strlen($num)-2,strlen($num)-1);
	$num = (int)$num;
	
	$numf = milmillon($num);
	
	return "".$numf." Y ".$cents."/100";
}

function formatFecha204($strfecha){
	if(strlen($strfecha)==10)$strfecha=$strfecha." 00:00:00";
	$dated = DateTime::createFromFormat("Y-m-d H:i:s", $strfecha);
	return $dated->format("YmdHis");
}

function formatAnho($strfecha){
	$dated = DateTime::createFromFormat("Y-m-d H:i:s", $strfecha);
	return $dated->format("Y");
}


?>