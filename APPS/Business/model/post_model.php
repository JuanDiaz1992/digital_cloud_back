<?php


require_once "gestionRestauranteSettings/Connection.php";
class PostModel{
    //Creación de Usuario nuevo 
    static public function postDataCreateInfoBusiness($table,$nameBusiness,$documentBusiness
    ,$description,$address,$numberPhone,$officeHours,$rutaArchivoRelativa)
    {   
        $sql = "INSERT INTO $table (
            name_business, 
            document_business, 
            logo, 
            Description, 
            office_hours, 
            address, 
            number_phone ) VALUES (
                :name_business, 
                :document_business, 
                :logo, 
                :Description, 
                :office_hours, 
                :address,
                :number_phone)";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindParam(':name_business', $userName);
        $stmt->bindParam(':document_business', $password);
        $stmt->bindParam(':logo', $name);
        $stmt->bindParam(':Description', $photo);
        $stmt->bindParam(':office_hours', $type_user);
        $stmt->bindParam(':address', $id_business);
        $stmt->bindParam(':number_phone', $id_business);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        if ($rowCount) {
            return 200;
        }else{
            return 400;
        }

        

    }

    //Este metodo es utilizado para consultar contraseña con el has
    static public function postDataconsultUser($table, $user, $password)
    {
        $sql = "SELECT * FROM $table WHERE username = :username";
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



    static public function PostDataModify($id,$name,$photo,$type_user)
    {   if($photo){
            $sql = "UPDATE profile_user SET photo = :photo, name = :name, type_user = :type_user WHERE id = :id";
            $stmt = Connection::connect()->prepare($sql);
            $stmt->bindParam(":photo", $photo, PDO::PARAM_STR);
        }else{
            $sql = "UPDATE profile_user SET name = :name, type_user = :type_user WHERE id = :id";
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
        $sql = "UPDATE profile_user SET password = :password WHERE id = :id";
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


//Este metodo es utilizado para consultar contraseña sin el has, 
//se debe usar en caso de que no exista un usuario Admin y sea necesario crear un Admin desde la bd

    // static public function postDataconsultUser($table,$user,$password){
    //     $sql = "SELECT * FROM $table WHERE username = :username AND password = :password";
    //     $stmt = Connection::connect()->prepare($sql);
    //     $stmt->bindParam(":username", $user, PDO::PARAM_STR);
    //     $stmt->bindParam(":password", $password, PDO::PARAM_STR);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_CLASS);
    // }
}



?>