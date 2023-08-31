<?php
require_once "APPS/Menu_management/controller/delete_controler.php";
$response = new DeleteController();

session_id($token);
session_start();
if($token && $_SESSION["type_user"] === 'Admin'){
    if(isset($data["delete_item_data"])){
        $response -> deleteItemTemporal($data["idItemMenu"]);
    }
    if (isset($data["delete_item_bd_from_menu"])) {
        $table = "items_menu";
        $response -> deleteItemFromMenuBd($table, $data["item"]);
    }
}else{
    badResponse();
}

?>