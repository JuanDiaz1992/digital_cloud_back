<?php
//Vista para solicitudes post del user

require_once "APPS/Documents/controller/post_controler.php";
require_once('digital_cloud_settings/Generator_token.php');
$response = new PostController();
$tokenDecode = Token::decodeToken($token);
if(isset($tokenDecode)){
    session_id($tokenDecode->id);
    session_start();
    if ($_POST["update_bill"]) {
        $img = isset($_FILES['photo'])? $_FILES['photo'] : '';
        $table = "facturas";
        $response -> postUpdateBill($table,$_POST,$img);
    }
}else{
    badResponse();
}

?>