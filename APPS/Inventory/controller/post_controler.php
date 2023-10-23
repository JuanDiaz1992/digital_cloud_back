<?php

require_once "APPS/Inventory/model/post_model.php";


class PostController{


    /************************Metodo para crear usuarios nuevos *********************/
    static public function postRecordInventoryController($table, $purchaseValue, $reason, $observations, $idProfile_user,$date){
            if ($purchaseValue && $reason &&  $idProfile_user) {
                if($observations ===""){
                    $observations = "No hay observaciones";
                }
                $response = PostModel::postRecordInventoryModel($table, $purchaseValue, $reason, $observations, $idProfile_user,$date);
                $return = new PostController();
                if ($response == 404){
                    $return -> fncResponse($response,404);
    
                }elseif($response == 200){
                    $return -> fncResponse($response,200);
                }
            }else{
                $json = array(
                    'status' => 404,
                    'message' => 'Hay datos sin rellenar'
                );
                echo json_encode($json, http_response_code($json['status']));
                exit;
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
