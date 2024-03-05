<?php
    class DB {
        // Constructor
    public function __construct() {

        }

        function insertUser($user){
            require '../DB/connection.php';
            $sql = "INSERT INTO user (name, apellido, domicilio, correo ) select 
            :name, :apellido, :domicilio, :correo 
            WHERE NOT EXISTS (
                SELECT 1 FROM user WHERE correo = :correo
            );";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $user['name']);
            $stmt->bindParam(':apellido', $user['apellido']);
            $stmt->bindParam(':domicilio', $user['domicilio']);
            $stmt->bindParam(':correo', $user['correo']);
            $stmt->execute();
            $pdo = null;
            return "ok";
        }
        function updateUser($user){
            require '../DB/connection.php';
            $sql = "UPDATE user 
            SET name = :name, 
                apellido = :apellido, 
                domicilio = :domicilio, 
                correo = :correo 
            WHERE id = :id;
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $user['name']);
            $stmt->bindParam(':apellido', $user['apellido']);
            $stmt->bindParam(':domicilio', $user['domicilio']);
            $stmt->bindParam(':correo', $user['correo']);
            $stmt->bindParam(':id', $user['id']);
            $stmt->execute();
            $pdo = null;
            return "ok";
        }

        
        function getUsers(){
            require '../DB/connection.php';
            $sql = "SELECT * FROM user WHERE active=1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pdo = null;
            return $data;
        }
        function desactive($data){
            require '../DB/connection.php';
            $sql = "UPDATE user set active=0
                    WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $data['id']);

            $stmt->execute();
            $pdo = null;
            return "ok";
        }

        function logIn($data){
            require '../DB/connection.php';
            $sql = "SELECT * FROM userLog WHERE username = :username and pass=:pass";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $data['username']);
            $stmt->bindParam(':pass', $data['pass']);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pdo = null;
            return $data[0];
        }

        
        
        
}

    
?>