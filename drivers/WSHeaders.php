<?php

namespace Drivers;

require_once "WSconfig.php";

if ((isset($_REQUEST) && isset($_SERVER["CONTENT_TYPE"])) || (isset($_REQUEST['action']))) {
    $ws_headers = [
        'Access-Control-Allow-Origin: *',
        'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept',
        'Access-Control-Allow-Methods: POST,GET',
        'Content-type:application/json',
    ];
    // Enviar múltiples encabezados HTTP
    foreach ($ws_headers as $ws_headers) {
        header($ws_headers);
    }
    //Parsear el request
    if(! empty($_REQUEST)){
        foreach($_REQUEST as $key => $value){
            $requestBody[$key] = $value;
        }
    }else{
        $content = trim(file_get_contents("php://input"));
        $requestBody = json_decode($content, true);
    }

    $requestBody['request_device_headers'] = [
        'device' => getDevice($_SERVER['HTTP_USER_AGENT']),
        'browse' => getBrowser($_SERVER['HTTP_USER_AGENT']),
        'keyUserAgent' => str_replace(' ', '', $_SERVER['HTTP_USER_AGENT']),
        'ip' => getClientIP($_SERVER)
    ];
    
    getClass($requestBody['action']);
    if (! is_array($requestBody)) {
        echo __LINE__;
        die("algo salio mal");
    }
} else {
    header("HTTP/1.0 404 Not Found");
    die( "Lo sentimos, la página que estás buscando no se encontró.");
    
}
