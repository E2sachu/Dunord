<?php

abstract class Request{
	static protected $instance = null;

	final private function __construct(){
		$this->server = $_SERVER;
		$this->get = $_GET;
		$this->post = $_POST;
	}
	final private function __clone(){}

	static public function getInstance(){
		if (is_null(self::$instance))
			self::$instance = new Request();
		return self::$instance;
	}

	static public function gp(){
		return array_merge($_GET, $_POST);
	}
	static public function pg(){
		return array_merge($_POST, $_GET);
	}
	

}