<?php
//Clase de la instancia de la base de datos
class Connection{
	//Preparando en un arreglo los datos de la base de datos de forma local
	public $db = array(
		"host" => "localhost",
		"user" => "root",
		"password" => "",
		"database" => "pruebatecnica"
	);
	//Se genera una variable publca para acceder a la conexion desde cualquier parte del aplicativo
	public $conn;

	public function __construct() {
	}
	//Si instancia la base de datos con sus respectiva base de datos, PDO
	public function conn () {
		$host = $this->db["host"];
		$database = $this->db["database"];
		$user = $this->db["user"];
		$password = $this->db["password"];
		//PDO String connection
		$this->conn = new \PDO("mysql:host=$host;dbname=$database", $user, $password);
		$this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}
}