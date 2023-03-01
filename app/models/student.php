
<?php
require '../app/utils/Connection.php';
    class student_model{
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
        //Retornamos la información de las notas del estudiantes ya promediadas
        public function tableNotas($idAlumno)
        {
            try {
                $connection = new Connection;
                $connection->conn();
                $statement = $connection->conn->prepare("select materia.materia , TRUNCATE(avg(notas.nota),2) as promedio from notas, materia where notas.idMateria = materia.id and notas.idAlumno=".$idAlumno." group by idAlumno");
                $statement->execute();
                $result = $statement->fetchAll();
                $n = count($result);
                $count = 1;
                for ($i = 0; $i <= $n - 1; $i++) {
                    //Se retorna todo en formato de tabla
                    echo "<tr><td>" . $count . "</td><td>" . $result[$i]['materia'] . "</td><td>" . $result[$i]['promedio'] . "</td></tr>";
                    $count +=1;
                }
            } catch (PDOException $e) {
                echo $e;
            }
        }

        //Retornamos el numero de materias cursadas por estudiante
        public function getNumberOfMaterias($idAlumno)
        {
            try {
                $connection = new Connection;
                $connection->conn();
                $statement = $connection->conn->prepare("select materia.materia , TRUNCATE(avg(notas.nota),2) as promedio from notas, materia where notas.idMateria = materia.id and notas.idAlumno=".$idAlumno." group by idAlumno");
                $statement->execute();
                $result = $statement->fetchAll();
                $n = count($result);
                return $n;
            } catch (PDOException $e) {
                echo $e;
            }
        }
        
    }
?>