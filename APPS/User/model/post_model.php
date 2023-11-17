<?php


require_once "digital_cloud_settings/Connection.php";
class PostModel{

         
    //Este metodo es utilizado para consultar contraseña con el has
    static public function postDataconsultUser($table, $user, $password)
    {
        $sql = "SELECT users.*FROM users WHERE username = :username";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindParam(":username", $user, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        // Verificar si se encontró un usuario con el nombre proporcionado
        if (count($result) > 0) {
            $hashedPassword = $result[0]->password;
            // Verificar si la contraseña ingresada coincide con el hash de la contraseña almacenada
            if (password_verify($password, $hashedPassword)) {
                // La contraseña es válida
                return $result;
            } else {
                // La contraseña es inválida
                return false;
            }
        } else {
            // No se encontró un usuario con el nombre proporcionado
            return false;
        }
    }

    //Creación de Usuario nuevo 
    static public function postDataCreateUser($userName, $password, $name, $photo, $type_user)
    {   
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindParam(":username", $userName, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        if($row){
            return 409;
        }else{
            $sql = "INSERT INTO users (username, password, name, photo, type_user) VALUES (:username, :password, :name, :photo, :type_user)";
            $stmt = Connection::connect()->prepare($sql);
            $stmt->bindParam(':username', $userName);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':photo', $photo);
            $stmt->bindParam(':type_user', $type_user);
            $stmt->execute();
            $rowCount = $stmt->rowCount();
            return 200;
        }

    }
    /*Funciones para modificar o cambiar contraseña de usuario*/
    static public function PostDataModify($id,$name,$photo,$type_user)
    {   if($photo){
            $sql = "UPDATE users SET photo = :photo, name = :name, type_user = :type_user WHERE id = :id";
            $stmt = Connection::connect()->prepare($sql);
            $stmt->bindParam(":photo", $photo, PDO::PARAM_STR);
        }else{
            $sql = "UPDATE users SET name = :name, type_user = :type_user WHERE id = :id";
            $stmt = Connection::connect()->prepare($sql);
        }
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":type_user", $type_user, PDO::PARAM_STR);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        if ($rowCount > 0){
            return 200;
        }else{
            return 404;
        }
        
    }

    static public function PostChagePassword($id,$password){
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $stmt = Connection::connect()->prepare($sql);
        
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        if ($rowCount > 0){
            return 200;
        }else{
            return 404;
        }
    }

}



?>