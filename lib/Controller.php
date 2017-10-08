<?php

class Controller {
	
	public $_smarty;
	
	public function __construct(){
		
		$this->_smarty = new Smarty;
		$this->atribuir('title', 'BG');
		$this->atribuir('name', 'Login');
		$this->atribuir('realTime', time()*1000);
		$this->atribuir('basePath', $this->basePath());
		
	}
	
	public function basePath() {
		
		$uri = (strpos($_SERVER['REQUEST_URI'], '?') !== false ? explode('/',substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'],'?'))) : explode('/',$_SERVER['REQUEST_URI']));
		$scr = explode('/',$_SERVER['SCRIPT_NAME']);
		
		for($i = 0 ; $i < count($scr) ; $i++) {
			if ($uri[$i] == $scr[$i]) {
				unset($uri[$i]);
			}
		}
		$basePath = '';
		for($i = 0 ; $i < (count($uri)-1); $i++) {
			$basePath.= '../';
		}
		return $basePath;
	}
	
	public function atribuir($chave, $valor){
		$this->_smarty->assign($chave, $valor);
	}
	
	public function renderizar($arquivo){
		$this->_smarty->display(VIEWS . $arquivo);
	}
	
	public function encrypt($str, $key){
	    for ($return = $str, $x = 0, $y = 0; $x < strlen($return); $x++){
	        $return{$x} = chr(ord($return{$x}) ^ ord($key{$y}));
	        $y = ($y >= (strlen($key) - 1)) ? 0 : ++$y;
	    }
	
	    return $return;
	}

}