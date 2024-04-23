<?php
require_once "cResponse.php";
require "cConections.php";

class cUser{
    public function create_user($request){
        $response = new cResponse();
        //Verificar que la informacion este limpia
        $key = $this->validate_fields_create_user($request);
        if($key !== true){
            $body = "El campo '$key' no es correcto";
            die($response->set_response($body));
        }
        //hashear el password
        $password = password_hash($request['password'], PASSWORD_BCRYPT, [
            'cost' => 12
        ]);
        //crear el usario en la base de datos
        $mysql = "INSERT into users (nickName,name,last_name,email,password,rol,create_user)
            values (?,?,?,?,?,?)";
        $tPr = "sssssis";
        $vPr = [
            $request['nickName'],
            $request['name'],
            $request['last_name'],
            $request['email'],
            $password,
            $request['rol'],
            date('Y-m-d H:i:s', time())
        ];
        $conns = new cConections();
        $sqlResult = $conns->stmtExecution($mysql, $tPr, $vPr);
        if($sqlResult->affected_rows > 0){
            $body = "Usuario creado";
            die($response->set_response($body , 'ok'));
        }else{
            $body = "No se creo usuario";
            die($response->set_response($body));
        }
    }

    private function validate_fields_create_user($request){
        
        foreach($request as $key => $value){
            if(($key === 'name' || $key === 'last_name') && strlen($value) < 3){
                return $key;
            }else if ($key === 'password' && strlen($value) < 6 ){
                return $key;
            }else if( $key === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)){
                return $key;
            }
        }
        return true;
    }

    public function getAllUser($request, $auth){
        $response = new cResponse();
        $mysql = "SELECT DISTINCT nickName,name,last_name,email,
                rol,create_user
                    FROM users 
                    WHERE ?";
        $tPr = "i";
        $vPr = [1];
        $conns = new cConections();
        $sqlResult = $conns->stmtExecution($mysql, $tPr, $vPr);
        $sqlResult = $sqlResult->get_result();
        while($row = $sqlResult->fetch_assoc()){
            $body[] = $row;
        }
        if(count($body) > 0){
            die($response->set_response($body , 'ok'));
        }else{
            $body = "No se creo usuario";
            die($response->set_response($body));
        }
    }
}