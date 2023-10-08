<?php


require_once "gestionRestauranteSettings/Connection.php";
class PostModel{
    //Creación de Usuario nuevo 
    static public function postRecordMenuyModel($table,$date){   
        $sql = "INSERT INTO $table (date) VALUES (:date)";
        $stmt = Connection::connect();
        $stmtFull =  $stmt->prepare($sql);
        $stmtFull->bindParam(':date', $date);
        $stmtFull->execute();
        $rowCount = $stmtFull->rowCount();
        $lastInsertId = $stmt->lastInsertId(); //Retorna el último id creado
        error_log($lastInsertId);
        if(isset($rowCount)){
            $data = [
                "id"=>$lastInsertId,
                "response"=>200
            ];
            return $data;
        }else{
            $data = [
                "response"=>400
            ];
            return $data;
        }

    }
    static public function postRecordAllMenusModel($table,$idMenu,$idItem,$date){   
        $sql = "INSERT INTO $table (menu,contenido, date, state) VALUES (:menu,:contenido,:date, :state)";
        $stateNumber = 1;
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindParam(':menu', $idMenu);
        $stmt->bindParam(':contenido', $idItem);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':state', $stateNumber);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        if(isset($rowCount)){
            return 200;
        }else{
            return 400;
        }

    }

    static public function createItemMenuModel($table,$name,$description,$price,$rutaArchivoRelativa,$menu_item_type,$idProfile_user,$amount){
        $sql = "INSERT INTO $table (name, description, price, picture, menu_item_type, idProfile_user, amount) VALUES (:name, :description, :price, :picture, :menu_item_type, :idProfile_user, :amount)";
        $stmt = Connection::connect()->prepare($sql);
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':picture', $rutaArchivoRelativa);
        $stmt->bindParam(':menu_item_type', $menu_item_type);
        $stmt->bindParam(':idProfile_user', $idProfile_user);
        $stmt->bindParam(':amount', $amount);
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