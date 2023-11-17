<?php
require_once "APPS/Documents/controller/get_controler.php";
require_once('digital_cloud_settings/Generator_token.php');
$tokenDecode = Token::decodeToken($token);
$response = new GetController();
if(isset($tokenDecode)){
    session_id($tokenDecode->id);
    session_start();
    if($table == 'inventoryBuysForDate'){
        $response -> getInventoryForDate("buys",$_GET["linkTo"],$_GET["equalTo"]);
    }
    else if($table == 'facturas'){

        $response -> getBillsController($table,$select,$_GET["equalTo"]);
    }
    else{
        //Aqui validamos si la consulta es de tipo where, sino es una consulta a toda la tabla 
        if (isset($_GET["linkTo"]) && isset($_GET["equalTo"])) {
            $response -> getDataFilter($table,$select,$_GET["linkTo"],$_GET["equalTo"]);
    
        }else{
            $response->getData($table,$select);
        }        
    }

    
}




?>