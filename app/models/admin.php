<?php

require '../app/utils/Connection.php';

//Creando clase para el manejo del login con sus respectivas sesiones
class admin_model{
    public function __construct() {
	}
    public function getIdByUsername($username){
        try{
            //Se prepara la instancia de conexion
            $connection = new Connection;
            $connection->conn();
            //Se hace la verificaión con la información de la base de datos.
            $statement = $connection->conn->prepare(
                "SELECT * FROM usuario WHERE usuario='$username'"
            );
            $statement->execute();
            $result = $statement->fetchAll();
            //Se obtiene el resultado y se retorna el id 
            if($result){
                return $result[0]["id"];
            }else{

            }
        }catch(PDOException $e){
            echo $e;
        }
    }

    public function getNameByUsername($username){
        try{
            //Se prepara la instancia de conexion
            $connection = new Connection;
            $connection->conn();
            //Se hace la verificaión con la información de la base de datos.
            $statement = $connection->conn->prepare(
                "SELECT * FROM usuario WHERE usuario='$username'"
            );
            $statement->execute();
            $result = $statement->fetchAll();
            //Se obtiene el resultado y se retorna el id 
            if($result){
                return $result[0]["nombre"];
            }else{

            }
        }catch(PDOException $e){
            echo $e;
        }
    }

    public function insertClass($name){
        try{
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'localhost:3000/User/insertClases',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{
                "titulo": "'.$name.'"
            }',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
              ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);

            $json = json_decode($response);
            if($json->status){
                echo "<script>alertify.success('Clase insertada correctamente!');</script>";

            }else{
                echo "<script>alertify.error('No se pudo ingresar, contacte a soporte!');</script>";
            }
            
        }catch(PDOException $e){
            echo $e;
        }
    }
    public function insertMateria($name, $idProfesor){
        try{
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'localhost:3000/User/insertMateria',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "materia":"'.$name.'",
                "idProfesor":'.$idProfesor.'
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $json = json_decode($response);
            if($json->status){
                echo "<script>alertify.success('Materia insertada correctamente!');</script>";

            }else{
                echo "<script>alertify.error('No se pudo ingresar, contacte a soporte!');</script>";
            }
        }catch(PDOException $e){
            echo $e;
        }
    }
    public function getClases(){
        try{
            //Se prepara la instancia de conexion
            $connection = new Connection;
            $connection->conn();
            //Se hace la verificaión con la información de la base de datos.
            $statement = $connection->conn->prepare(
                "SELECT * from clase"
            );
            $statement->execute();
            $result = $statement->fetchAll();
            //Se obtiene el resultado y se retorna el id 
            $n = count($result);
            for ($i = 0; $i <= $n - 1; $i++) {
                //Se retorna todo en combobox
                echo "<option value='".$result[$i]['id']."'>".$result[$i]['titulo']."</option>";
            }
        }catch(PDOException $e){
            echo $e;
        }
    }

    public function getTeachers(){
        try{
            //Se prepara la instancia de conexion
            $connection = new Connection;
            $connection->conn();
            //Se hace la verificaión con la información de la base de datos.
            $statement = $connection->conn->prepare(
                "SELECT usuario.* FROM usuario WHERE rol=1 and usuario.id not in (select idProfesor from materia)"
            );
            $statement->execute();
            $result = $statement->fetchAll();
            //Se obtiene el resultado y se retorna el id 
            $n = count($result);
            for ($i = 0; $i <= $n - 1; $i++) {
                //Se retorna todo en combobox
                echo "<option value='".$result[$i]['id']."'>".$result[$i]['nombre']."</option>";
            }
        }catch(PDOException $e){
            echo $e;
        }
    }
    public function insertUser($username, $password, $name, $classId, $rol){
        try{
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'localhost:3000/User/insertUser',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "name": "'.$name.'",
                "user":"'.$username.'",
                "password":"'.$password.'",
                "class":'.$classId.',
                "rol":'.$rol.'
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $json = json_decode($response);
            if($json->status){
                echo "<script>alertify.success('Usuario insertado correctamente!');</script>";
                header("Location: /frontEndprueba/www/user/adminIndex");
                
            }else{
                echo "<script>alertify.error('No se pudo ingresar, contacte a soporte!');</script>";
            }
        }catch(PDOException $e){
            echo $e;
        }
    }
}