<?php

require_once "APPS/Inventory/model/delete_model.php";


class DeleteController{

    static public function deleteItemInvetoryController($table,$id){
        $response = DeleteModel::deleteItemInvetoryModel($table,$id);
        $return = new DeleteController();
        $return -> fncResponse($response);
    }
    static public function deleteItemTemp($idItemMenu){
        
        $return = new DeleteController();
        $tempArray = array();
        foreach($_SESSION["menu_temp"] as  $key => $existingItem){
            if($existingItem["id"]!=$idItemMenu){
                array_push($tempArray, $existingItem);
            }
        }
        unset($_SESSION["menu_temp"]);
        $_SESSION["menu_temp"] = $tempArray;
        $response = 200;
        $return -> fncResponse($response);

    }


    //Respuesta del controlador:
    public function fncResponse($response){
        if ($response === 200) {
            $json = array(
                'status' => 200,
                'message' => 'Dato eliminado con exito'
            );
        }else if($response === 404){
            $json = array(
                'status' => 404,
                'message' => 'Ocurrió un error al eliminar el dato',
                'results' => 'Not Found'
            );
        }
        echo json_encode($json,http_response_code($json['status']));

    
    }
}


?>