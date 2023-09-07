<?php

require_once "APPS/Menu_management/model/post_model.php";


class PostController{


    //Esta parte es la encargada de gestionar el menú 
    static public function createMenuTemp($item){
        $return = new PostController();
        if (!isset($_SESSION["menu_temp"])){
            $_SESSION["menu_temp"] = array();
        }
    
        $itemExists = 0;
        foreach ($_SESSION["menu_temp"] as $existingItem) {
            if ($existingItem["id"] === $item["id"]) {
                $itemExists = 1;
                break;
            }
        }
        if ($itemExists === 0) {
            array_push($_SESSION["menu_temp"], $item);
            $response = $_SESSION["menu_temp"];
            $return -> fncResponse($response,200);
        } else {
            $response = "";
            $return -> fncResponse($response,409);
        }
    }
    static public function createItemMenu($table,$name,$description,$price,$photo,$menu_item_type,$idProfile_user){
        if(isset($photo['name'])){ //Si el formulario incluye una imagen, la agrega, sino se pone la img por defecto
            $carpetaDestino = __DIR__ . "../../../../files/images/MenuItems";
            $nombreArchivo = $photo['name'];
            $rutaArchivo = $carpetaDestino . DIRECTORY_SEPARATOR . $nombreArchivo;
            
            if (!is_dir($carpetaDestino)) {
                mkdir($carpetaDestino, 0777, true);
            }
            
            $rutaArchivoRelativa = 'files/images/MenuItems/' . $nombreArchivo;
            
            move_uploaded_file($photo['tmp_name'], $rutaArchivo);
        }else{//Si no hay una foto, se incluye la foto por defecto
            $rutaArchivoRelativa = "files/images/sin_imagen.webp";
        }
        if(!isset($price)){
            $price = 0;
        }
        $response = PostModel::createItemMenuModel($table,$name,$description,$price,$rutaArchivoRelativa,$menu_item_type,$idProfile_user);
        $return = new PostController();
        if ($response == 404){
            $return -> fncResponse($response,404);

        }elseif($response == 200){
            $return -> fncResponse($response,200);
        }
    }


    static public function createMenu($date){
        $menuTemp = $_SESSION["menu_temp"];
        $response = PostModel::postRecordMenuyModel("menu",$date);
        $return = new PostController();
        $allElementsSaved = true; // Variable de registro
        if ($response["response"] === 200 ) {
            foreach ($menuTemp as $element){
                // error_log(print_r($response, true));
                // error_log($response["id"]);
                $responseItem = PostModel::postRecordAllMenusModel("all_menus",$response["id"],$element["id"],$date);
                if($responseItem !== 200){
                    $allElementsSaved = false;
                    break;
                }
            }
            if ($allElementsSaved) {
                $_SESSION["menu_temp"] = [];
                // Todos los elementos se guardaron correctamente, enviar respuesta exitosa
                $return->fncResponse("MEnú creado correctamente", 200);
                
            } else {
                // Al menos un elemento falló, enviar respuesta de error
                $return->fncResponse("Error al crear el menú", 404);
            }
        }else{
            $return -> fncResponse($response,404);
        }

    }
    

    //Respuesta del controlador:
    public function fncResponse($response,$status){ //Metodo usado para dar respuestas básicas
        if (!empty($response) && $status === 200) {
            $json = array(
                'status' => $status,
                'results' => 'success',
                'registered'=>true,
                'response'=>$response,
                'message' => "Registro ingresado correctamente" 
            );
        }else if($status === 409){
            $json = array(
                'registered'=>false,
                'status' => $status,
                'results' => 'Not Found',
                'message' => "El elemento ya existe"
            );
        }else{
            $json = array(
                'registered'=>false,
                'status' => 404,
                'results' => 'Not Found',
                'message' => "No se pudo realizar el registro, valide los datos e intentelo de nuevo"
            );
        }

        echo json_encode($json,http_response_code($json['status']));

    
    }


}


?>
