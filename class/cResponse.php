<?php

class cResponse{

    public function set_response($body = null ,$code = 'fail')
    {
        return json_encode([
            "responseBody"=>$body,
            "code"=>$code
        ]);
    }

}