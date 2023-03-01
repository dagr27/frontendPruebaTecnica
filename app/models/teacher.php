
<?php
require '../app/utils/Connection.php';
    class teacher_model{
        public function __construct() {
        }
        
        //Creando una funcion para obtener el id del usuario estudiante en cuestion
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

        //Creando una funcion para obtener el id de la clase segun el profesor en cuestion
        public function getIdClassByUsername($username){
            try{
                //Se prepara la instancia de conexion
                $connection = new Connection;
                $connection->conn();
                //Se hace la verificaión con la información de la base de datos.
                $statement = $connection->conn->prepare(
                    "SELECT idClase FROM usuario WHERE usuario='$username'"
                );
                $statement->execute();
                $result = $statement->fetchAll();
                //Se obtiene el resultado y se retorna el id 
                if($result){
                    return $result[0]["idClase"];
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
        //Obtenemos el id de la materia que imparte el profesor
        public function getIdMateria($username)
        {
            try {
                $idClase = $this->getIdByUsername($username);
                $connection = new Connection;
                $connection->conn();
                $statement = $connection->conn->prepare("select * from materia where idprofesor = ".$idClase."");
                $statement->execute();
                $result = $statement->fetchAll();
                return $result[0]["id"];
            } catch (PDOException $e) {
                echo $e;
            }
        }
        //Obtenemos la materia que imparte el profesor
        public function getMateria($username)
        {
            try {
                $idClase = $this->getIdByUsername($username);
                $connection = new Connection;
                $connection->conn();
                $statement = $connection->conn->prepare("select * from materia where idprofesor = ".$idClase."");
                $statement->execute();
                $result = $statement->fetchAll();
                return $result[0]["materia"];
            } catch (PDOException $e) {
                echo $e;
            }
        }
        //Retornamos la información de las notas del estudiantes ya promediadas
        public function tableEstudiantes($username)
        {
            try {
                $idClase = $this->getIdClassByUsername($username);
                $materia = $this->getMateria($username);
                $idMateria = $this->getIdMateria($username);
                $connection = new Connection;
                $connection->conn();
                $statement = $connection->conn->prepare("select id, nombre from  usuario where idClase = ".$idClase." and rol=2");
                $statement->execute();
                $result = $statement->fetchAll();
                $n = count($result);
                $count = 1;
                for ($i = 0; $i <= $n - 1; $i++) {
                    //Se retorna todo en formato de tabla
                    echo "<tr><td>" . $count . "</td><td>" . $result[$i]['nombre'] . "</td><td><a data-toggle='modal' data-target='#updateGrades' data-name='" . $result[$i]['nombre'] . "' data-id='" . $result[$i]['id'] . "' data-idmateria='" . $idMateria. "' data-Materia='" . $materia. "'><i class='far fa-edit'></i></a></td></tr>";
                    $count +=1;
                }
            } catch (PDOException $e) {
                echo $e;
            }
        }

        public function tableEstudiantesAVG($username)
        {
            try {
                $idClase = $this->getIdClassByUsername($username);
                $connection = new Connection;
                $connection->conn();
                $statement = $connection->conn->prepare("select usuario.nombre, truncate(avg(notas.nota),2) as avg from usuario, notas where usuario.id = notas.idAlumno and usuario.idClase=".$idClase." group by usuario.id");
                $statement->execute();
                $result = $statement->fetchAll();
                $n = count($result);
                $count = 1;
                for ($i = 0; $i <= $n - 1; $i++) {
                    //Se retorna todo en formato de tabla
                    echo "<tr><td>" . $count . "</td><td>" . $result[$i]['nombre'] . "</td><td>" . $result[$i]['avg'] . " </td></tr>";
                    $count +=1;
                }
            } catch (PDOException $e) {
                echo $e;
            }
        }

        //Retornamos el numero de estudiantes en la clase
        public function getNumberOfStudents($username)
        {
            try {
                $idClase = $this->getIdClassByUsername($username);
                $connection = new Connection;
                $connection->conn();
                $statement = $connection->conn->prepare("select count(*) as conteo from usuario where idClase = ".$idClase." and rol=2");
                $statement->execute();
                $result = $statement->fetchAll();
                return $result[0]["conteo"];
            } catch (PDOException $e) {
                echo $e;
            }
        }
        public function insertGrades($idAlumno, $idMateria, $nota){
            try{
                //Se instancia curl para realizar la petición al api
                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => 'localhost:3000/User/addCalifications',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                    "idAlumno":'.$idAlumno.',
                    "idMateria":'.$idMateria.',
                    "nota": '.$nota.'
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
    
                //se decodifica la respuesta
                $json = json_decode($response);
                if($json->status){
                    echo "<script>alertify.success('Nota insertada correctamente!');</script>";

                }else{
                    echo "<script>alertify.error('No se pudo ingresar, contacte a soporte!');</script>";
                }
            }catch(PDOException $e){
                echo $e;
            }
        }
        
    }
?>