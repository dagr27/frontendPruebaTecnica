<?php

require '../app/utils/Connection.php';

//Creando clase para el manejo del login con sus respectivas sesiones
class login_model{
    public function __construct() {
	}
    //Creando una funcion global para validar las credenciales de inicio de sesion
    public function login($username, $password){
        try{
            //Se instancia curl para realizar la petición al api
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'localhost:3000/User/auth',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //se parsea el metodo que se usara
            CURLOPT_CUSTOMREQUEST => 'POST',
            //se manda en formato json los parametros de interes
            CURLOPT_POSTFIELDS =>'{
                "username":"'.$username.'",
                "password":"'.$password.'"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            ));

            //se envia la petición
            $response = curl_exec($curl);

            curl_close($curl);

            //se decodifica la respuesta
            $json = json_decode($response);
            if($json->status){
                //si todo bien se evalua el rol del usuario para redireccionarlo a su ambiente
                switch ($json->rol) {
                    case 0:
                        $_SESSION["admin"] = $username; 
                        header("Location: /frontEndprueba/www/user/adminIndex");
                        break;
                    case 1:
                        $_SESSION["teacher"] = $username; 
                        header("Location: /frontEndprueba/www/user/teacherIndex");
                        break;
                    case 2:
                        $_SESSION["student"] = $username; 
                        header("Location: /frontEndprueba/www/user/studentIndex");
                        break;
                }
            }else{
                echo "<script>alertify.error('Su usuario o contraseña estan incorrectos!');</script>";
            }
        }catch(PDOException $e){
            echo $e;
        }
    }
}