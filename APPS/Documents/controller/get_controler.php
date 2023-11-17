<?php


require_once "APPS/Documents/model/get_model.php";

class GetController{
    static public function getData($table,$select){
        $response = GetModel::getData($table,$select);
        $return = new GetController();
        $return -> fncResponse($response);


    }
    static public function getDataFilter($table,$select,$linkTo,$equalTo){
        $response = GetModel::getDataFilter($table,$select,$linkTo,$equalTo);
        $return = new GetController();
        $return -> fncResponse($response);

    }

    static public function getBillsController($table,$select,$equalTo){
        $response = GetModel::getBills($table,$select,$equalTo);
        $return = new GetController();
        $return -> fncResponse($response);
    }
    static public function getDataBySession(){
        $response = $_SESSION["menu_temp"];
        $return = new GetController();
        $return -> fncResponse($response);
    }


    
    //Respuesta del controlador:
    public function fncResponse($response, $consultUsers=false){
        if (!empty($response)&&$consultUsers ===false) {
            $json = array(
                'status' => 200,
                'total' => count($response),
                'results' => $response
                
            );        
        }else{
            $json = array(
                'status' => 404,
                'results' => 'Not Found'
            );
        }
        echo json_encode($json,http_response_code($json['status']));

    
    }
}


?>