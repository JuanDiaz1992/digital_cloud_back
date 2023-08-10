<?php
require_once "APPS/User/controller/get_controler.php";
$response = new GetController();

if(isset($token)){
    session_id($token);
    session_start();
    
    if(isset($_SESSION["estatus"]) == true){
        //Se valida si la solicitud get es a la tabla user, si es así se bloquea el acceso
        if($table === "profile_user" && !$_SESSION["type_user"] === 'Admin'){
            badResponse();
        }elseif($table === "profile_user" && $_SESSION["type_user"] === 'Admin'){
            $response->getAllUsers($table,$select);
        }    
        elseif($table == 'validateSession' ) {
            $response -> validateUSer($_SESSION["username"]);
        }
    
        else{
            //Aqui validamos si la consulta es de tipo where, sino es una consulta a toda la tabla 
            if (isset($_GET["linkTo"]) && isset($_GET["equalTo"])) {
                $response -> getDataFilter($table,$select,$_GET["linkTo"],$_GET["equalTo"]);
        
            }else{
                $response->getData($table,$select);
            }
        
        
        }
    
    
    
    }else{
        badResponse();
    }
    
}




?>