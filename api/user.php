<?php

require "../drivers/WSHeaders.php";

switch ($requestBody['action']) {
    case 'createUser':
        $user = new cUser();
        $user->create_user($requestBody);
        break;
    case 'logIn':
        $user = new cLog();
        $user->logIn($requestBody);
        break;
}
