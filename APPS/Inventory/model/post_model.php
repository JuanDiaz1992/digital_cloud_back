<?php


require_once "gestionRestauranteSettings/Connection.php";
class PostModel{
    //Creación de Usuario nuevo 
    static public function postRecordInventoryModel($table, $purchaseValue, $reason, $observations, $idProfile_user,$date){   
       
        $sql = "INSERT INTO $table (purchaseValue, reason, observations, idProfile_user, date) VALUES (:purchaseValue, :reason, :observations, :idProfile_user, :date)";
        $stmt = Connection::connect()->prepare($sql);
        
        $stmt->bindParam(':purchaseValue', $purchaseValue);
        $stmt->bindParam(':reason', $reason);
        $stmt->bindParam(':observations', $observations);
        $stmt->bindParam(':idProfile_user', $idProfile_user);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        if(isset($rowCount)){
            return 200;
        }else{
            return 400;
        }

    }


}



?>