<?php

class SubcategoriaModel extends Model{
	
	public $_tabela = "subcategoria";
	
	public function inserir(Array $dados){
		return $this->insert($dados);
	}
	
	public function pesquisar($where = null, $campos = null, $order = null, $limite = null){
		return $this->read($where, $campos, $order, $limite);
	}
	
	public function atualizar(Array $dados, $primaryKey, $where = null){
		return $this->update($dados, $primaryKey, $where);
	}
	
	public function excluir(Array $dados, $primaryKey){
		return $this->delete($dados, $primaryKey);
	}
	
}