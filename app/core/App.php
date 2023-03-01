<?php
//Se crea la clase principal para poder manjar todo el aplicativo
class App {
	//Se crean sus atributos principales, y los default
	protected $controller = 'home';
	protected $method = 'index';
	protected $params = [];
	//EL constructor para parsear las url que se van pidiendo desde el usuario
	public function __construct() {
		$url = $this->parseUrl();

		if (file_exists('../app/controllers/'. @$url[0] .'_controller.php')) {
			$this->controller = $url[0];
		}
		unset($url[0]);
		require_once '../app/controllers/'. $this->controller .'_controller.php';

		$this->controller = new $this->controller;
		//Se verifica si hay una url en la primera pocision del arreglo
		if (isset($url[1])) {

			if (method_exists($this->controller, $url[1])) {
				$this->method = $url[1];
			}
		}
		
		/*if (isset($url[2])) {
			echo $url[2];
			echo$this->controller;
			if (method_exists($this->controller, $url[1])) {
				$this->method = $url[2];
			}
		}*/
		
		//Una vez usada, se suelta para poder usarla luego nuevamente
		unset($url[1]);
		$this->params = $url ? array_values($url) : [];
		array_unshift($this->params);

		call_user_func_array([$this->controller, $this->method], $this->params);
	}

	public function parseUrl () {
		//Se recorre la url
		if (isset($_GET['url'])) {
			return $url = explode('/',filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}

}