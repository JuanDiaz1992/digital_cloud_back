<?php
//Vista para solicitudes post del user

require_once "APPS/User/controller/post_controler.php";
require_once('digital_cloud_settings/Generator_token.php');
$response = new PostController();
if(isset($data["login_request"])){
    $table = "users";
    $response -> postDataconsultUser($table, $data["username"], $data["password"]);
    exit;
}else{
    $tokenDecode = Token::decodeToken($token);
    if(isset($tokenDecode)){
        session_id($tokenDecode->id);
        session_start();
        if($_SESSION["type_user"] === 1){
            if(isset($_POST["newUser_request"])){
                $img = isset($_FILES['photo'])? $_FILES['photo'] : '';
                $response ->postControllerCreateUser(
                    $_POST['userName'],
                    $_POST['password'],
                    $_POST['confirmPassword'],
                    $_POST['name'],
                    $img,
                    $_POST['type_user'],
                    );
                }else if(isset($_POST["edit_user_request"])){
                    $img = isset($_FILES['photo'])? $_FILES['photo'] : '';
                    $response ->postControllerModify(
                        $_POST['id'],
                        $_POST['name'],
                        $img,
                        $_POST['type_user'],
                        $_POST['username']
                        );    
                }else if(isset($data['changePasswordUser'])){
                        $response ->changePassword(
                            $data['id'],
                            $data['password'],
                            $data['confirmPassword'],
                        );  
                }else{
                    badResponse();
                }
            }
    }
}







?>