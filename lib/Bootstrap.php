<?php

class Bootstrap {
	
	private $_exploder;
	private $_url;
	
	public $_controller;
	public $_action;
	
	public function __construct(){
		
		$this->setExplode();
		$this->setUrl();
		$this->setController();
		$this->setAction();
		
	}

	public static function capitalize($text) {

		$words = explode('-', $text);
		$text = '';
		foreach ($words as $word) {
			$text.= ucfirst($word);
		}
		return $text;
	}
	
	private function setExplode(){
		
		$uri = (strpos($_SERVER['REQUEST_URI'], '?') !== false ? explode('/',substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'],'?'))) : explode('/',$_SERVER['REQUEST_URI']));
		$scr = explode('/',$_SERVER['SCRIPT_NAME']);

		for($i = 0 ; $i < count($scr) ; $i++) {
			if ($uri[$i] == $scr[$i]) {
				unset($uri[$i]);
			}
		}

		$this->_exploder = implode('/', $uri);
		
	}
	
	private function setUrl(){
		
		$url = (isset($this->_exploder) && !empty($this->_exploder) ? $this->_exploder : 'index/index');
		$this->_url = $url;
		
	}
	
	private function setController(){

		$controller = explode('/', $this->_url);
		$this->_controller = $controller[0];
		
	}
	
	private function setAction(){

		$action = explode('/', $this->_url);
		$this->_action = (isset($action[1]) && !empty($action[1]) ? $action[1] : 'index');
		
	}
	
	public function run(){
		
		$controller = $this->capitalize($this->_controller);
		$action = lcfirst($this->capitalize($this->_action));

		$controllerPath = CONTROLLERS . $controller . 'Controller.php';

		if(!file_exists($controllerPath))
			die("Controlador \"{$controllerPath}\" nao existe");
			
		require_once($controllerPath);	
		
		$controllerName = $controller.'Controller';
		$class = new $controllerName();
			
		if(!method_exists($class, $action . 'Action'))
			die("A&ccedil;&atilde;o \"{$this->_action}Action\" nao existe");
		
		$Method = new ReflectionMethod($controllerName, $action.'Action');
		$Method->invoke($class);
		
	}
	
}