<?php
require_once "cResponse.php";
require "cConections.php";

class cBlog
{
    public function newPost($request, $auth)
    {
        $response = new cResponse();
        if (!$this->validatePost($request)) {
            $body = "El post es muy corto";
            die($response->set_response($body));
        };

        $mysql = "INSERT INTO posts (id_user,created_post,tittle,description) 
            VALUES (?,?,?,?)";
        $tPr = "isss";
        $vPr = [
            $auth->idUser,
            date('Y-m-d H:i:s', time()),
            $request['tittle'],
            $request['description']
        ];
        $conns = new cConections();
        $sqlResult = $conns->stmtExecution($mysql, $tPr, $vPr);
        if ($sqlResult->affected_rows > 0) {
            $body = "Post creado";
            die($response->set_response($body, 'ok'));
        } else {
            $body = "No se creo post";
            die($response->set_response($body));
        }
    }

    public function editPost($request, $auth)
    {
        $response = new cResponse();
        if (!$this->validatePost($request)) {
            $body = "El post es muy corto";
            die($response->set_response($body));
        };

        $mysql = "UPDATE posts SET tittle = ?,  description = ? , date_last_edit = ?
            WHERE id_post = ?";
        $tPr = "sssi";
        $vPr = [
            $request['tittle'],
            $request['description'],
            date('Y-m-d H:i:s', time()),
            $request['idPost'],
        ];
        $conns = new cConections();
        $sqlResult = $conns->stmtExecution($mysql, $tPr, $vPr);
        if ($sqlResult->affected_rows > 0) {
            $mysql = "INSERT INTO post_history (id_post,id_user,tittle,description, created_History) 
            values (?,?,?,?,?)";
            $tPr = "iisss";
            $vPr = [
                $request['idPost'],
                $auth->idUser,
                $request['tittle'],
                $request['description'],
                date('Y-m-d H:i:s', time()),
            ];
            $conns = new cConections();
            $sqlResult = $conns->stmtExecution($mysql, $tPr, $vPr);
            $body = "Post editado";
            die($response->set_response($body, 'ok'));
        } else {
            $body = "No se edit post";
            die($response->set_response($body));
        }
    }

    public function deletePost($request, $auth)
    {
        $response = new cResponse();
        $mysql = "SELECT DISTINCT id_post,tittle,description
                    FROM ometlcom_kreativeco_db.posts WHERE id_post = ?";
        $tPr = "i";
        $vPr = [
            $request['idPost'],
        ];
        $conns = new cConections();
        $sqlResult = $conns->stmtExecution($mysql, $tPr, $vPr);
        $sqlResult = $sqlResult->get_result();
        $post = $sqlResult->fetch_assoc();
        $sqlResult->close();

        $mysql = "DELETE FROM posts WHERE id_post = ?";
        $tPr = "i";
        $vPr = [
            $request['idPost']
        ];
        $conns = new cConections();
        $sqlResult = $conns->stmtExecution($mysql, $tPr, $vPr);
        if ($sqlResult->affected_rows > 0) {
            $mysql = "INSERT INTO post_history (id_post,id_user,tittle,description, created_History,edit_val) 
            values (?,?,?,?,?,?)";
            $tPr = "iissss";
            $vPr = [
                $post['id_post'],
                $auth->idUser,
                $post['tittle'],
                $post['description'],
                date('Y-m-d H:i:s', time()),
                'deleted'
            ];
            $conns = new cConections();
            $sqlResult = $conns->stmtExecution($mysql, $tPr, $vPr);
            $body = "Post eliminado";
            die($response->set_response($body, 'ok'));
        } else {
            $body = "No se elimino post";
            die($response->set_response($body));
        }
    }

    public function getAllPost($request, $auth){
        $response = new cResponse();
        $mysql = "SELECT DISTINCT u.nickName,u.name,u.last_name,u.rol,
                p.tittle,p.description,p.created_post
                    FROM users u 
                JOIN posts p ON p.id_user = u.id_user 
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

    public function validatePost($request)
    {
        return strlen($request['description']) > 5 ? true : false;
    }
}
