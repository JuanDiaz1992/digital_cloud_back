<?php

require_once "digital_cloud_settings/Connection.php";
$response = new GetController();
class GetModel{
    //Peticiones get sin filtro
    static public function getData($table, $select){
        $sql = "SELECT $select FROM $table";
        $stmt = Connection::connect()->prepare($sql);
        $stmt-> execute();
        return $stmt-> fetchAll(PDO::FETCH_CLASS);
    }
    static public function getBills($table, $select,$equalTo){
        $sql = "SELECT $select FROM $table WHERE date = :date";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindParam(':date',$equalTo);
        $stmt-> execute();
        return $stmt-> fetchAll(PDO::FETCH_CLASS);
    }
    //Peticiones get con filtro
    static public function getDataFilter($table,$select,$linkTo,$equalTo){
        error_log($linkTo);
        error_log($equalTo);
        $linkToArray = explode(",",$linkTo);
        $equalToArray = explode("_",$equalTo);
        $linkToText = "";

        if (count($linkToArray)>1){
            foreach($linkToArray as $key => $value){
                if($key > 0){
                    $linkToText .= "AND ".$value." = :".$value." ";                }
            }
        }                
        $sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkToText";
        $stmt = Connection::connect()->prepare($sql);
        foreach($linkToArray as $key => $value){
            $stmt -> bindParam(":".$value,$equalToArray[$key],PDO::PARAM_STR);
        }

        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_CLASS);

    }

    static public function getInventoryForDateModel($table,$linkTo,$equalTo){
        $linkToArray = explode(",",$linkTo);
        $equalToArray = explode("_",$equalTo);
        $linkToText = "";
        if (count($linkToArray)>1){
            foreach($linkToArray as $key => $value){
                if($key > 0){
                    $linkToText .= "AND ".$value." = :".$value." ";                }
            }
        }                
        $sql = "SELECT * FROM $table WHERE DATE($linkToArray[0]) = :$linkToArray[0] $linkToText";
        $stmt = Connection::connect()->prepare($sql);
        foreach($linkToArray as $key => $value){
            $stmt -> bindParam(":".$value,$equalToArray[$key],PDO::PARAM_STR);
        }

        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_CLASS);
    }



}
    



?>