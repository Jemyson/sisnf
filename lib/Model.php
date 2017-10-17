<?php

class Model {
	
	protected $db;
	public $_tabela;
	
	public function __construct(){

		if(file_exists(CON_PATH.DS.'config.ini')) {
			$config = parse_ini_file(CON_PATH.DS.'config.ini', true);
			
			$host = $config['db']['host'];
			$db = $config['db']['dbname'];
			$user = $config['db']['user'];
			$pass = $this->encrypt($config['db']['password'], 'SistemaP5153');
	
			$this->db = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			
		}else{
			die("erro");
		}
				
	}
	
	public function encrypt($str, $key){
	    for ($return = $str, $x = 0, $y = 0; $x < strlen($return); $x++){
	        $return{$x} = chr(ord($return{$x}) ^ ord($key{$y}));
	        $y = ($y >= (strlen($key) - 1)) ? 0 : ++$y;
	    }
	
	    return $return;
	}
		
	public function nextKey(){
		
		$resultado = current($this->db->query("SHOW TABLE STATUS LIKE '{$this->_tabela}'")->fetchAll(PDO::FETCH_ASSOC));
		return $resultado['Auto_increment'] ;		
	
	}
	
	public function insert(Array $dados){
		
		$campos = implode(", ", array_keys($dados));
		$camposValores = ":" . implode(", :", array_keys($dados));
		
		$stm = $this->db->prepare("INSERT INTO {$this->_tabela} ({$campos}) VALUES ({$camposValores}) ");

		foreach($dados as $chave=>$valor){
			$stm->bindValue(":{$chave}", $valor);
		}

		return $stm->execute();
			
	}
	
	public function read($whereParametro = null, $campos = null, $orderParametro = null, $limite = null){
		
		$camposSelect = '*';
		$where = '';
		$order = '';
		
		if($campos != null && is_array($campos)){
			
			$camposSelect = implode(', ', $campos);
			
		}
		
		if($whereParametro != null && is_array($whereParametro)){
			
			$where = ' WHERE ';
			
			foreach($whereParametro as $chave=>$valor){
				
				$where .= implode(' AND ', $valor);
				
				if($chave != end(array_keys($whereParametro)) ){
					
					$where .= ' AND ';
					
				}
				
			}
			
		}else{
			
			if($whereParametro != null){
				$where = ' WHERE ' . $whereParametro;
			}
			
		}
		
		if($orderParametro != null && is_array($orderParametro)){
			
			$order = ' ORDER BY ';
			
			foreach($orderParametro as $chave2=>$valor2){
				
				$order .= $valor2;
				
				if($chave2 != end(array_keys($orderParametro)) ){
					
					$order .= ' , ';
					
				}
				
			}
			
		}else if($orderParametro != null){
			$order = $orderParametro;
		}
					
		return $this->db->query("SELECT {$camposSelect} FROM {$this->_tabela} {$where} {$order} {$limite} ")->fetchAll(PDO::FETCH_ASSOC);
		
	}
	
	public function update(Array $dados, $primaryKey, $where = null){
		
		$valorPrimaryKey = $dados[$primaryKey];

		unset($dados[$primaryKey]);
		
		$campos = array();
		
		
		foreach($dados as $chave=>$valor){
			$campos[] = "{$chave} = :{$chave}";
		}
		
		$campos = implode(', ', $campos);

		$stm = $this->db->prepare("UPDATE {$this->_tabela} SET {$campos} WHERE {$primaryKey} = :{$primaryKey} ");
		
		foreach($dados as $chave=>$valor){
			$stm->bindValue(":{$chave}", $valor);
		}
		
		$stm->bindValue(":{$primaryKey}", $valorPrimaryKey);

		return $stm->execute();
		
	}
	
	public function delete(Array $dados, $primaryKey, $where = null){
		
		$stm = $this->db->prepare("DELETE FROM {$this->_tabela} WHERE {$primaryKey} = :{$primaryKey} ");
		$stm->bindValue(":{$primaryKey}", $dados[$primaryKey]);
		
		return $stm->execute();
		
	}
	
}