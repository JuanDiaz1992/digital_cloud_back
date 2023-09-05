<?php
//Vista para solicitudes post del user

require_once "APPS/Menu_management/controller/post_controler.php";
$response = new PostController();
session_id($token);
session_start();

if($token && $_SESSION["type_user"] === 'Admin'){
    if (isset($data["menu_temp"])) {
        $response -> createMenuTemp($data["item"]);
    }else if(isset($_POST["new_item_menu"])){
        $table = "items_menu";
        $img = isset($_FILES['photo'])? $_FILES['photo'] : '';
        $response -> createItemMenu(
            $table,
            $_POST["name"],
            $_POST["description"],
            $_POST["price"],
            $img,
            $_POST["menu_item_type"],
            $_POST["idProfile_user"],
        );
    }else if(isset($data["create_menu"])){
        $response -> createMenu();
    }

}else{
    badResponse();
}




?>