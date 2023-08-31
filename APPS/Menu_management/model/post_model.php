<?php


require_once "gestionRestauranteSettings/Connection.php";
class PostModel{
    //Creación de Usuario nuevo 
    static public function postRecordInventoryModel($table, $purchaseValue, $reason, $observations, $idProfile_user){   
       
        $sql = "INSERT INTO $table (purchaseValue, reason, observations, idProfile_user) VALUES (:purchaseValue, :reason, :observations, :idProfile_user)";
        $stmt = Connection::connect()->prepare($sql);
        
        $stmt->bindParam(':purchaseValue', $purchaseValue);
        $stmt->bindParam(':reason', $reason);
        $stmt->bindParam(':observations', $observations);
        $stmt->bindParam(':idProfile_user', $idProfile_user);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        if(isset($rowCount)){
            return 200;
        }else{
            return 400;
        }

    }

    static public function createItemMenuModel($table,$name,$description,$price,$rutaArchivoRelativa,$menu_item_type,$idProfile_user){
        $sql = "INSERT INTO $table (name, description, price, picture, menu_item_type, idProfile_user) VALUES (:name, :description, :price, :picture, :menu_item_type, :idProfile_user)";
        $stmt = Connection::connect()->prepare($sql);
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':picture', $rutaArchivoRelativa);
        $stmt->bindParam(':menu_item_type', $menu_item_type);
        $stmt->bindParam(':idProfile_user', $idProfile_user);
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