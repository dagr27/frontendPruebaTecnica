<?php
    class user_model{
        public function __construct() {
        }
        
        //Creando una funcion global para validar las credenciales de inicio de sesion
        public function login($id){
            try{
                //Se prepara la instancia de conexion
                $connection = new Connection;
                $connection->conn();
                //Se hace la verificaión con la información de la base de datos.
                $statement = $connection->conn->prepare(
                    "SELECT * FROM usuario WHERE username='$username' AND password='$password'"
                );
                $statement->execute();
                $result = $statement->rowCount();
                //Se obtiene el resultado y se valida el tipo de usuario
                if($result){
                    //Redireccionamiento
                    $_SESSION["user"] = $username; 
                    header("Location: /LexaWarehouse/www/module/home");
                }else{
                    //De no encontar nada imprimir alerta
                    echo "<script>alertify.error('Su usario o contraseña estan incorrectos!');</script>";
                }
            }catch(PDOException $e){
                echo $e;
            }
        }
    }
?>