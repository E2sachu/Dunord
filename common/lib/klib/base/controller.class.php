<?php
namespace KLib;

abstract class BaseController{
	
	protected $args = array();
	protected $action = null;
	protected $beforeMethod = null;
	protected $execMethod = null;
	protected $afterMethod = null;

	public static function run($ctrl=null, $action=null, $args=array()){
		$classCtrl = Config::getKey('CRTL_ROUTES', strtolower($ctrl));
		if (!is_string($classCtrl) || !class_exists($classCtrl)){
			if (class_exists('DefaultController')){
				if (method_exists('DefaultController', $ctrl))
					$action = $ctrl;
				$classCtrl = 'DefaultController';

			}else
				throw new \Exception('INVALID CONTROLLER', 404);
		}
		$args['controller'] = $classCtrl;
		$args['controllerAction'] = $action;
		$ctrl = new $classCtrl($action, $args);
		$ctrl->runAction();
	}

	public function __construct($action, $args){
		if (!array_key_exists($action, $this->actions)){
			if (!method_exists($this, 'defaultMethod'))
				throw new \Exception('ACTION NOT FOUND', 404);
			else
				$action = '';
		}
		$this->action = $action;
		$this->args = $args;
		$this->execMethod = $this->actions[$action];
	}

	public function runAction(){
		if (!method_exists($this, $this->execMethod['run']) && method_exists($this, 'defaultMethod'))
			$this->execMethod['run'] = 'defaultMethod';
		elseif (!method_exists($this, $this->execMethod['run']))
			throw new \Exception('ACTION NOT FOUND', 404);
		$run = $this->execMethod['run'];
		$before = null;
		//FILTER HTTP METHOD
		if (array_key_exists('method', $this->execMethod) && is_string($this->execMethod['method']) && !empty($this->execMethod['method'])){
			if ($_SERVER['REQUEST_METHOD'] != $this->execMethod['method'])
				throw new \Exception('Method Not Allowed', 405);
		}else{
			$this->execMethod['method'] = 'GET';
		}
		//FILTER ARGUMENTS
		if (array_key_exists('validator', $this->execMethod) && is_string($this->execMethod['validator']) && !empty($this->execMethod['validator'])){
			$validator = $this->execMethod['validator'];
			if (!\VALIDATOR::$validator())
				throw new \Exception('Precondition Failed', 412);
		}
		if (array_key_exists('before', $this->execMethod) && is_string($this->execMethod['before']) && !empty($this->execMethod['before']))
			$before = $this->execMethod['before'];
		$after = null;
		if (array_key_exists('after', $this->execMethod) && is_string($this->execMethod['after']) && !empty($this->execMethod['after']))
			$after = $this->execMethod['after'];
		//EXECUTTION
		if (method_exists($this->args['controller'], $before))
			$this->$before();
		$this->$run();			
		if (method_exists($this->args['controller'], $after))
			$this->$after();
	}
}