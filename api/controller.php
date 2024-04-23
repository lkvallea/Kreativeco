<?php
require "../drivers/WSHeaders.php";
require "../drivers/auth.php";

switch ($requestBody['action']) {
    case 'newPost':
        //variable Auth valida el token y el rol para el acceso a los metodos. 
        $blog = $auth->rol > 1 ? new cBlog() : die("acceso no permitido");
        $blog->newPost($requestBody, $auth);
        break;
    case 'editPost':
        //variable Auth valida el token y el rol para el acceso a los metodos. 
        $blog = $auth->rol > 2 ? new cBlog() : die("acceso no permitido");
        $blog->editPost($requestBody, $auth);
        break;
    case 'deletePost':
        //variable Auth valida el token y el rol para el acceso a los metodos. 
        $blog = $auth->rol > 3 ? new cBlog() : die("acceso no permitido");
        $blog->deletePost($requestBody, $auth);
        break;
    case 'getAllPost':
        //variable Auth valida el token y el rol para el acceso a los metodos. 
        $blog = $auth->rol > 3 ? new cBlog() : die("acceso no permitido");
        $blog->getAllPost($requestBody, $auth);
        break;
        case 'getAllUser':
            //variable Auth valida el token y el rol para el acceso a los metodos. 
            $blog = $auth->rol > 4 ? new cUser() : die("acceso no permitido");
            $blog->getAllUser($requestBody, $auth);
            break;
}
