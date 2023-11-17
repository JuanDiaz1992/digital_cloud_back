<?php
require_once "APPS/Documents/controller/delete_controler.php";
$response = new DeleteController();


session_id($token);
session_start();
if($token && $_SESSION["type_user"] === 'Admin'){
    if(isset($data["delete_buy_inventory"])){
        $table = "buys";
        $response -> deleteItemInvetoryController($table,$data["idItem"]);

    }
}else{
    badResponse();
}
?>