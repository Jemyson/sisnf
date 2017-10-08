<?php

class AppController extends Controller{
	
	public function __construct(){
		
		parent::__construct();
		
		$this->checkLogged();
		$this->montarMenu();
		
		$this->atribuir('usuarioLogado', $_SESSION['usuario']);
		$this->atribuir('nomeUsuario', $_SESSION['usuario']['nome']);
		$this->atribuir('nomeServidor', $_SESSION['servidor']['nome']);
		
		if(!isset($_SESSION['chavesAcesso'])){
			$this->renderizar('acessoNegado.tpl');
			die();
		}
		
	}
	
	public function checkLogged() {

		if(!isset($_SESSION['usuario']) || !isset($_SESSION['servidor']) || $_SESSION['usuario']['tipo_login'] != 'logado') {
			header("Location: {$this->basePath()}login/index");
			die();
		}
	}
	
	protected function variaveisPaginacao($total, $limite, $pagina) {
	
		$paginas = ceil($total/$limite);
	
		if(empty($pagina)) {
			$pagina = 1;
		}else{
			if($pagina > $paginas){
				$pagina = $paginas;
			}
		}
	
		$inicio = abs(($pagina - 1) * $limite);

		return array('inicio'=>$inicio, 'limite'=>$limite, 'total'=>$total, 'pagina'=>$pagina, 'paginas'=>$paginas);
	}
	
	protected function montarMenu(){

		$funcionalidades = $_SESSION['funcionalidades'];

		$this->atribuir('funcionalidades', $funcionalidades);
		
	}
	
	protected function retornarDados($resultado, $controles){
		
		$inicio = $controles['inicio'];
		$limite = $controles['limite']; 
		$pagina = $controles['pagina'];
		$paginas = $controles['paginas'];
		$total = $controles['total'];
		
		$ini = 0;
		$fin = 0;
		$retornados = count($resultado);
		$de = ($retornados > 0 ? $inicio + 1 : 0);
		$ao = ($retornados > 0 ? $inicio + $retornados : 0);
	
		$exibidas = $limite;
		$intervalos = $paginas / $exibidas;
		for ($i = 0 ; $i < $intervalos ; $i++) {
			$ini = ($i == 0 ? 1 : ($i * $exibidas));
			$fin = (($i * $exibidas) + $exibidas);
			($fin > $paginas ? $fin = $paginas : null);
			if($pagina >= $ini && $pagina < $fin){
				break;
			}
		}
		
		print_r(json_encode(array('registros'=>$resultado, 'controle'=>array('de'=>(int)$de, 'ao'=>(int)$ao, 'pagina'=>(int)$pagina, 'limite'=>(int)$limite, 'paginas'=>(int)$paginas, 'indiceInicio'=>(int)$ini, 'indiceFim'=>(int)$fin, 'retornados'=>(int)$retornados, 'total'=>(int)$total))));
	}
	
	public function utf8E($mixed){
	
		if(is_array($mixed)){
			foreach($mixed as $key => $value){
				$mixed[$key] = $this->utf8E($value);
			}
			return $mixed;
		}else{
			$mixed = utf8_encode($mixed);
		}
		return $mixed;
	}	
	
	public function utf8D($mixed){
	
		if(is_array($mixed)){
			foreach($mixed as $key => $value){
				$mixed[$key] = $this->utf8D($value);
			}
			return $mixed;
		}else{
			$mixed = utf8_decode($mixed);
		}
		return $mixed;
	}	
	
	public function encrypt($str, $key){
	    for ($return = $str, $x = 0, $y = 0; $x < strlen($return); $x++){
	        $return{$x} = chr(ord($return{$x}) ^ ord($key{$y}));
	        $y = ($y >= (strlen($key) - 1)) ? 0 : ++$y;
	    }
	
	    return $return;
	}

	public function insert(Array $dados, $db, $tabela){
		
		$campos = implode(", ", array_keys($dados));
		$camposValores = ":" . implode(", :", array_keys($dados));
		
		$stm = $db->prepare("INSERT INTO {$tabela} ({$campos}) VALUES ({$camposValores}) ");

		foreach($dados as $chave=>$valor){
			$stm->bindParam(":{$chave}", $a = $valor);
		}

		return $stm->execute();
			
	}
	
	public function update(Array $dados, $primaryKey, $db, $tabela){
		
		$valorPrimaryKey = $dados[$primaryKey];

		unset($dados[$primaryKey]);
		
		$campos = array();
		
		
		foreach($dados as $chave=>$valor){
			$campos[] = "{$chave} = :{$chave}";
		}
		
		$campos = implode(', ', $campos);

		$stm = $db->prepare("UPDATE {$tabela} SET {$campos} WHERE {$primaryKey} = :{$primaryKey} ");
		
		foreach($dados as $chave=>$valor){
			$stm->bindParam(":{$chave}", $a = $valor);
		}
		
		$stm->bindParam(":{$primaryKey}", $a = $valorPrimaryKey);

		return $stm->execute();
		
	}
	
	public function retornarLog(){
		return Log::newLog('logs/log.log');
		//return Log::newLog('/home/ubuntu/logs/log.log');
	}
	
}