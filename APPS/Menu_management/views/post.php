<?php
//Vista para solicitudes post del user

require_once "APPS/Menu_management/controller/post_controler.php";
$response = new PostController();

if (isset($data["menu_temp"])) {
    session_id($token);
    session_start();
    if($token && $_SESSION["type_user"] === 'Admin'){
        $response -> createMenuTemp($data["item"]);
    }else{
        badResponse();
    }
}else if(isset($_POST["new_item_menu"])){
    session_id($token);
    session_start();
    if($token && $_SESSION["type_user"] === 'Admin'){
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
    }else{
        badResponse();
    }
}
    
    
else{
    badResponse();
}





?>