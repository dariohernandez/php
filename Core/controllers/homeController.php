<?php 

class HomeController {

	public function __construct(){}

	 public function index(){

		require_once(DIR_HTML ."home/home.html");
	}

	public function error(){
		echo "Error en la URL del request. Operaciones invalidas";
	}

}



 ?>