<?php
require_once "APPS/User/controller/delete_controler.php";
$response = new DeleteController();
if(isset($data["logout_request"])){
    $response -> logout($data["token"]);
    error_log("Session Destroy From Delete");
}

elseif(isset($data["delete_user"])){
    session_id($token);
    session_start();
    if($token && $_SESSION["type_user"] === 'Admin'){
        $response -> deleteUserController($data["id"],);
    }else{
        badResponse();
    }
    
}


?>