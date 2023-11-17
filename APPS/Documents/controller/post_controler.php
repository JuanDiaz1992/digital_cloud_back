<?php

require_once "APPS/Documents/model/post_model.php";


class PostController{


    /************************Metodo para crear usuarios nuevos *********************/
    static public function postUpdateBill($table, $POST, $photo){
            if (isset($POST["date"]) && isset($photo)  &&  isset($POST["total"]) ) {
                $partes = explode("-", $POST["date"]);
                $año = $partes[0];
                $mes = $partes[1];
                $carpetaDestino = "files/facturas/". $año.'/'. $mes;
                $nombreArchivo = $photo['name'];
                $rutaArchivo = $carpetaDestino . DIRECTORY_SEPARATOR . $nombreArchivo;
                if (!is_dir($carpetaDestino)) {
                    mkdir($carpetaDestino, 0777, true);
                }
                $rutaArchivoRelativa = 'files/facturas/' . $año.'/'. $mes .'/'. $nombreArchivo;
                move_uploaded_file($photo['tmp_name'], $rutaArchivo);
                error_log($rutaArchivoRelativa);
                $response = PostModel::postUpdateBillModel($table, $POST, $rutaArchivoRelativa);
                $return = new PostController();
                if ($response["status"] == 404){
                    $return -> fncResponse($response,404);
    
                }elseif($response["status"] == 200){
                    $return -> fncResponse($response["id"],200);
                }
            }else{
                $json = array(
                    'status' => 404,
                    'message' => 'Por favor completa todos los campos'
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
