<?php
    class homeModel{
        private $PDO;
        public function __construct()
        {
            require_once("c://xampp/htdocs/Programacion-Web/config/db.php");
            $pdo = new db();
            $this->PDO = $pdo->conexion();
        }
        public function agregarNuevoUsuario($cedula,$password){
            $statement = $this->PDO->prepare("INSERT INTO usuarios values(null,:cedula, :password)");
            $statement->bindParam(":cedula",$cedula);
            $statement->bindParam(":password",$password);
            try {
                $statement->execute();
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }
        public function obtenerclave($cedula){
            $statement = $this->PDO->prepare("SELECT password FROM usuarios WHERE cedula = :cedula");
            $statement->bindParam(":cedula",$cedula);
            return ($statement->execute()) ? $statement->fetch()['password'] : false;
        }
    }

?>