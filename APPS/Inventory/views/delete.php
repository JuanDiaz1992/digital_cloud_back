<?php
require_once "APPS/Inventory/controller/delete_controler.php";
$response = new DeleteController();

function firtsValidateUserAdmin($response,$token,$argTable,$argID){
    session_id($token);
    session_start();
    if($token && $_SESSION["type_user"] === 'Admin'){
        $table = $argTable;
        $response -> deleteItemInvetoryController($table,$argID);
    }else{
        badResponse();
    }
}

if(isset($data["delete_buy_inventory"])){
    $table = "buys";
    firtsValidateUserAdmin($response,$token,$table,$data["idItem"]);
    
}else if(isset($data["delete_bills_inventory"])){
    $table = "bills";
    firtsValidateUserAdmin($response,$token,$table,$data["idItem"]);
}


?>