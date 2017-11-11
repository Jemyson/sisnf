<?php

require_once CONTROLLERS.'ClienteController.php';
require_once MODELS.'VendaModel.php';

class NotaFiscalController extends AppController{
	
	public function indexAction(){

		$clienteController = new ClienteController();
		$this->atribuir('dadosCliente', $clienteController->dadosEntidade());
		
		$this->renderizar('notaFiscalGrid.tpl');
		
	}

	public function dadosAction(){

		$model = new VendaModel();
		
		$where = null;
		
		if(isset($_REQUEST['filtros'])){
			$where = $_REQUEST['filtros'];
		}
		
		$where[] = array('nfe IS NOT NULL');
		
		$resultadoCount = current($model->pesquisar($where, array('count(*) as total')));
		
		$controles = $this->variaveisPaginacao($resultadoCount['total'], (!empty($_REQUEST['limite']) ? $_REQUEST['limite'] : 1), (!empty($_REQUEST['pagina']) ? $_REQUEST['pagina'] : 1));

		$order = array();
		if(!empty($_REQUEST['sort_col'])){
			$order[]= $_REQUEST['sort_col'].($_REQUEST['sort_dir'] ? ' '.$_REQUEST['sort_dir'] : '');
		}
		
		$resultado = $model->read($where, null, $order, "LIMIT {$controles['limite']} OFFSET {$controles['inicio']}");
		
		$this->retornarDados($resultado, $controles);
		
	}
	
	public function formAction(){
	
		$model = new VendaModel();
		
		if(!isset($_REQUEST['id'])){
			
			$codigo = $model->nextKey();
			$this->atribuir('id', $codigo);
			$this->atribuir('hash', md5('sisnf'.$codigo));
			
		}else{
			
			$codigo = (int) $_REQUEST['id'];
			$dados = current($model->read('id = ' . $codigo));
			
			$this->atribuir('id', $codigo);
			$this->atribuir('idCliente', $dados['id_cliente']);
			$this->atribuir('nfe', $dados['nfe']);
			$this->atribuir('hash', md5('sisnf'.$codigo));
			
		}
				
		$this->renderizar('notaFiscalForm.tpl');
		
	}
	
	
	public function emitirAction(){
		
		require_once 'lib/emitirNfe.php';
		
	}
	
}