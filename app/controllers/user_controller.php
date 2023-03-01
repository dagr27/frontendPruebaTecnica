<?php

class User extends Controller {

	//Metodos del estudiante
	public function studentIndex() {
		$this->view('student/home');
	}
	public function califications() {
		$this->view('student/califications');
	}
	//Metodos del administrador
	public function adminIndex(){
		$this->view('admin/home');
	}
	
	//Metodos del Teacher
	public function teacherIndex(){
		$this->view('teacher/home');
	}
	public function grades(){
		$this->view('teacher/grades');
	}	
	public function close(){
		session_destroy();
		header("Location: /frontEndprueba/www/");
	}
    
} 