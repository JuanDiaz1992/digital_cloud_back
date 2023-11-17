<?php


require_once "digital_cloud_settings/Connection.php";
class DeleteModel{
    //Metodo para eliminar usuario de la bd
    static public function deleteUserModel($id){
        $sql = "DELETE FROM users WHERE id = :id ";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            return 200;
        } else {
            return 404;
        }
        
    }
}



?>