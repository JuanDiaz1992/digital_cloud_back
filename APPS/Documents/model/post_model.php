<?php


require_once "digital_cloud_settings/Connection.php";
class PostModel{
    //Creación de Usuario nuevo 
    static public function postUpdateBillModel($table, $POST, $photo){
        $sql = "INSERT INTO $table (date, picture, total) VALUES (:date, :picture, :total)";
        $stmt = Connection::connect();
        $stmtFull = $stmt->prepare($sql);
        $stmtFull->bindParam(':date', $POST["date"]);
        $stmtFull->bindParam(':picture', $photo);
        $stmtFull->bindParam(':total', $POST["total"]);
        $stmtFull->execute();
        $rowCount = $stmtFull->rowCount();
        $lastId = $stmt->lastInsertId(); 
        if(isset($rowCount)){
            $objetc = [
                'status'=>200,
                'id'=>$lastId
            ];
            return $objetc;
        }else{
            $objetc = [
                'status'=>400,
            ];
            return $objet;
        }

    }


}



?>