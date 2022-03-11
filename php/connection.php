<?php
    // Class que conecta con la base de datos
    class SQLConnection extends PDO{
        private $host = "localhost"; // host para el localhost
        private $dbname = "maquetacion"; // Nombre de BDD
        private $user = "root"; // Nombre de usuario de BDD
        private $pass = ""; // Contraseña de BDD

        public function __construct()
        {
            try{
                // Conectar a la BDD mediante PDO
                parent::__construct("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->user, $this->pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                exit;
            }
        }
    }
?>
