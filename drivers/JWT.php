<?php

class JWT
{
    public function validate_password($data,$resquest){
        if (!password_verify($resquest['password'], $data['token'])){
            return false;
        }
        // Declarar variables necesarias
        $alg = "sha256";
        $type = "JWT";
        $filepath = '../users/';
        $time = time();
        $nextDay = $time + (3600 * 24);
        // Configurara 1er Parte
        $encodeHeaderLevel = base64_encode(json_encode([
            'alg' => $alg,
            'typ' => $type
        ]));
        // Configurara 2da Parte  
        $encodeBody = base64_encode(json_encode([
            'startDay' => $time,
            'lifeDay' => $nextDay,
            'nickName' => $data['nickName'],
            'rol' => $data['rol'],
            'log' => 'on',
            'idUser' => $data['id_user'],
        ]));
        // Configurara 3er Parte 
        $headerPayload = $encodeHeaderLevel . '.' . $encodeBody;
        $secretKey = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 12);
        $signature = base64_encode(hash_hmac($alg, $headerPayload, $secretKey, TRUE));
        $sessionParam = json_encode([
            'sk' => $secretKey,
            'rqt' => $time
        ]);
        // Guarda la SECRET KEY en un path del servidor para asegurar la codificacion.
        $filepath = $filepath . $data['id_user'] . '/';
        if (! is_dir($filepath)) {
            mkdir($filepath);
        }
        $filepath .= 'SK_' . $resquest['request_device_headers']['device'] . '-' . $resquest['request_device_headers']['browse'] . '.txt';
        if (! file_put_contents($filepath, $sessionParam)) {
            return false;
        }
        //retorna el JWT
        return $headerPayload . '.' . $signature;
    }

    public  function validate_token($server,$device)
    {
        $jwt = $this->get_bearer_token($server);
        if (empty($jwt)) {
            return false;
        }
        $jwt = explode('.', $jwt);
        $params = json_decode(base64_decode($jwt[1]));
        $filepath = '../users/' . $params->idUser;
        if (file_exists($filepath) != true) {
           return false;
        }
        $filepath .= '/SK_' . $device['device'] . '-' . $device['browse'] . '.txt';
        if (file_exists($filepath) != true) {
            return false;
        }
        $sessionParam = json_decode(file_get_contents($filepath));
        if ($sessionParam == false) {
            return false;
        }
        $requestSignature = stripslashes($jwt[2]);
        $validateSignature = base64_encode(hash_hmac('sha256', $jwt[0] . '.' . $jwt[1], $sessionParam->sk, TRUE));
        if ($validateSignature === $requestSignature) {
            return $params;
        }
        return false;
    }

    private function parse_token($token)
    {
        $token = explode('.', $token);
        echo (base64_decode($token[2]));
        if (count($token) === 3) {
            $jwt['SHA_256'] = json_decode(base64_decode($token[0]));
            $jwt['params'] = json_decode(base64_decode($token[1]));
            $jwt['sk'] = (base64_decode($token[2]));
            die(json_encode($jwt));
            return $jwt;
        }
        return null;
    }

    private function get_authorization_header($server)
    {
        
       // die(json_encode($server));
        $headers = null;
        if (isset($server['Authorization'])) {
            $headers = trim($server["Authorization"]);
        } else if (isset($server['HTTP_AUTHORIZATION'])) { //fast CGI
            $headers = trim($server["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    private function get_bearer_token($server)
    {
        $headers = $this->get_authorization_header($server);
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }
}
