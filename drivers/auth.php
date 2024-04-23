<?php
require "JWT.php";
require_once "../class/cResponse.php";

class auth
{
    public function validate_access( $device)
    {
        $jwt = new JWT();
        $response = new  cResponse();
        $jwt = $jwt->validate_token($_SERVER,$device);
        if ($jwt === false) {
            $body = "Sesion invalida";
            die($response->set_response($body));
        }
        return $jwt;
    }
}

if ((isset($_REQUEST) && isset($_SERVER["CONTENT_TYPE"])) || (isset($_REQUEST['action']))) {
    $auth = new auth();
    $auth = $auth->validate_access($requestBody['request_device_headers']);
}

