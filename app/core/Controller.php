<?php
//Main controller
class Controller {
	//Creando funcion que se encarga de abstraer los modelos para su uso en el aplicativo
	public function model ($model) {
		require_once '../app/models/'. $model .'.php';
	}
	//Creando funcion que permitira tomar las vistas y sus parametros en forma de arreglo
	public function view ($view, $data = []) {
		require_once '../app/views/'. $view .'.php';
	}
}