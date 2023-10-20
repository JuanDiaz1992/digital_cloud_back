<?php

require_once "APPS/Business/model/post_model.php";


class PostController{
    static public function postControllerCreateinfoBusiness($table,$nameBusiness,$documentBusiness
    ,$description,$address,$numberPhone,$officeHours,$photo){    
        if (!preg_match('/^[a-zA-Z0-9ñÑ]+$/', $nameBusiness) || //En este if se validan caracteres especiales
            !preg_match('/^[a-zA-Z0-9-_]+$/', $documentBusiness) ||
            !preg_match('/^[a-zA-Z0-9ñÑ-_]+$/', $description) ||
            !preg_match('/^[a-zA-Z0-9ñÑ-_#]+$/', $address) ||
            !preg_match('/^[a-zA-Z0-9ñÑ-_#]+$/', $officeHours) ||
            !preg_match('/^[0-9-_]+$/', $numberPhone)) {
                $json = array(
                    'status' => 404,
                    'is_logged_in' => false,
                    'message' => 'Los datos no pueden contener caracteres especiales'
                );
                echo json_encode($json, http_response_code($json['status']));
                exit;
            }           
            if(isset($photo['name'])){
                $carpetaDestino = __DIR__ . "/../files/images/business_profile/";
                $nombreArchivo = $photo['name'];
                $rutaArchivo = $carpetaDestino . DIRECTORY_SEPARATOR . $nombreArchivo;
                if (!is_dir($carpetaDestino)) {
                    mkdir($carpetaDestino, 0777, true);
                }
                $rutaArchivoRelativa = 'files/images/business_profile/'. $nombreArchivo;
                move_uploaded_file($photo['tmp_name'], $rutaArchivo);
            }else{
                $rutaArchivoRelativa = "";
            }
            $response = PostModel::postDataCreateInfoBusiness($table,$nameBusiness,$documentBusiness
            ,$description,$address,$numberPhone,$officeHours,$rutaArchivoRelativa);
            $return = new PostController();
            if ($response == 404){
                $return -> fncResponse($response,404);

            }elseif($response == 200){
                $return -> fncResponse($response,200);
            }
            



    }//***********************Este metodo es usado para el inicio de sessión***************/
    static public function postDataconsultUser($table,$username,$password){ 

        if (!preg_match('/^[a-zA-Z0-9]+$/', $username) || !preg_match('/^[a-zA-Z0-9]+$/', $password)) { //Si el usuario o contraseña incluyen caracteres, no permite continúar
            $json = array(
                'status' => 404,
                'is_logged_in' => false,
                'message' => 'El usuario o la contraseña no pueden contener caracteres especiales.' 
            );
            echo json_encode($json,http_response_code($json['status']));

        }else{//Si no hay caracteres especiales se envía la información al modelo para validar si el usuario y la contraseña coinciden
            $response = PostModel::postDataconsultUser($table,$username,$password);
            $return = new PostController();
            $return -> isUserOk($response);
        }


    }
    static public function postControllerModify($id, $name, $photo, $type_user, $userName){
        if (
            !preg_match('/^[a-zA-Z\s]+$/', $name) ||
            !preg_match('/^[a-zA-Z0-9]+$/', $type_user)) {
                $json = array(
                    'status' => 404,
                    'is_logged_in' => false,
                    'message' => 'Los datos no pueden contener caracteres especiales'
                );
                echo json_encode($json, http_response_code($json['status']));
                exit;
            }
           
            if(isset($photo['name'])){ //Si el formulario incluye una imagen, la agrega, sino se pone la img por defecto
                $carpetaDestino = __DIR__ . "/../files/user_profile/" . $userName;
                $nombreArchivo = $photo['name'];
                $rutaArchivo = $carpetaDestino . DIRECTORY_SEPARATOR . $nombreArchivo;
                
                if (!is_dir($carpetaDestino)) {
                    mkdir($carpetaDestino, 0777, true);
                }
                
                $rutaArchivoRelativa = 'files/user_profile/' . $userName .'/'. $nombreArchivo;
                
                move_uploaded_file($photo['tmp_name'], $rutaArchivo);
            }else{
                $rutaArchivoRelativa = false;
            }

            $response = PostModel::PostDataModify($id, $name, $rutaArchivoRelativa, $type_user);
            $return = new PostController();
            if ($response == 409){
                $return -> fncResponse($response,409);

            }elseif($response == 200){
                $return -> fncResponse($response,200);
            }
          
    }
    static public function changePassword($id,$password,$confirmPassword){
        if (!preg_match('/^[a-zA-Z0-9]+$/', $password) ||
        !preg_match('/^[a-zA-Z0-9]+$/', $confirmPassword)) {
            $json = array(
                'status' => 404,
                'message' => 'Los datos no pueden contener caracteres especiales'
            );
            echo json_encode($json, http_response_code($json['status']));
            exit;
        }

        if ($password !== $confirmPassword) { //Aquí se valida que la contraseña sea correcta 
            $json = array(
                'status' => 404,
                'is_logged_in' => false,
                'message' => 'Las contraseñas no coinciden'
            );
            echo json_encode($json, http_response_code($json['status']));
            exit;
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); //Aquí se genera un hash para la contraseña
            $response = PostModel::PostChagePassword($id,$hashedPassword);
            $return = new PostController();
            if ($response == 404){
                $return -> fncResponse($response,404);

            }elseif($response == 200){
                $return -> fncResponse($response,200);
            }
    }
    public function isUserOk($response){ //Si el usuario y contraseña coinciden, se inicia sesión
        if (!empty($response)) {
            $new_id = rand(3000, 11500); //Se genera un id para la sesión el cuál servirá como token en el front
            session_id($new_id);
            session_set_cookie_params(1800);
            session_start();
            $_SESSION["username"] = $response[0]->username; //Se guardan las variables de sesión
            $_SESSION["estatus"] = true;
            $_SESSION["type_user"] = $response[0]->type_user;
            $json = array( //Se devuelve el json con la información necesaria para inicia la sesión en el front
                'status' => 200,
                'is_logged_in' => true, 
                'token' => $new_id,
                'username'=> $_SESSION["username"],
                "message"=> "Usuario correcto",
                "name"=> $response[0]->name,
                "type_user" => $response[0]->type_user,
                "photo" => $response[0]->photo
            );
        }else{
            $json = array( //Si la contraseña o el usuario son incorrectos, se devuelve la respuesta 
                'status' => 404,
                'is_logged_in' => false,
                'message' => 'User or password incorrect' 
            );
        }
        echo json_encode($json,http_response_code($json['status']));

    } 
    
    //Respuesta del controlador:
    public function fncResponse($response,$status){ //Metodo usado para dar respuestas básicas
        if (!empty($response) && $status === 200) {
            $json = array(
                'status' => $status,
                'results' => 'success',
                'registered'=>true,
                'message' => "Registro ingresado correctamente" 
            );
        }else if($status === 409){
            $json = array(
                'registered'=>false,
                'status' => $status,
                'results' => 'Not Found',
                'message' => "El usuario ya existe"
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