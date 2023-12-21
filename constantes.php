<?php
$bduser = 'root';
$bdpass = '';
$bdserver = 'localhost';
$bdscheme = 'db_seida';
$macaddress="9C:2D:CD:68:19:87";
$ipaddress="172.16.170.181";
$ruc = "20100010136";
$username = "MODDATOS";
$password = "moddatos";

$envelope='<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:wsa="http://schemas.xmlsoap.org/ws/2004/08/addressing">
    <soap:Header>
        <wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
            <wsse:UsernameToken wsu:Id="UsernameToken-2">
			    <wsse:Username/>
                <wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText"/>
            </wsse:UsernameToken>
        </wsse:Security>
    </soap:Header>
    <soap:Body>
        <recibirArchivo xmlns="http://services.sigad.sunat.gob.pe">
            <numeroTransaccion xmlns=""/>
            <informacionArchivo xmlns=""/>
        </recibirArchivo>
    </soap:Body>
</soap:Envelope>
';

//Factura
$IGV = 18;
$PriceTypeCode = "01";




?>