<?php
require_once "cResponse.php";
require "cConections.php";
require "../drivers/JWT.php";

class cLog
{
    public function logIn($request)
    {
        $response = new cResponse();
        $sql_field = $this->parseUserVar($request);
        $mysql = "SELECT DISTINCT id_user,nickName,name,last_name,email,rol,
            status,password as token
                FROM users WHERE $sql_field = ?";
        $tPr = "s";
        $vPr = [$request['user']];
        $conns = new cConections();
        $sqlResult = $conns->stmtExecution($mysql, $tPr, $vPr);
        $sqlResult = $sqlResult->get_result();
        if($sqlResult->num_rows > 0){
            $responseBody = $sqlResult->fetch_assoc();
            $jwt = new JWT();
            $jwt = $jwt->validate_password($responseBody,$request);
            if($jwt === false){
                $body = "Usuario o Contraseña invalidos";
                die($response->set_response($body));
            }
            $body['message'] = "Login correcto.";
            $body['token'] = $jwt;
            die($response->set_response($body, 'ok'));
        }
        $body = "Usuario o Contraseña invalidos";
        die($response->set_response($body));
    }

    private function parseUserVar($request)
    {
        return filter_var($request['user'], FILTER_VALIDATE_EMAIL) ? "email" : "nickName";
    }
}
