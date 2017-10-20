<?php

require_once MODELS.'VendaModel.php';
require_once MODELS.'VendaProdutoModel.php';
require_once MODELS.'ProdutoModel.php';
require_once CONTROLLERS.'ClienteController.php';

class VendaController extends AppController{
	
	public function indexAction(){
		
		$clienteController = new ClienteController();
		$this->atribuir('dadosCliente', $clienteController->dadosEntidade());
		
		$this->renderizar('vendaGrid.tpl');
	}
	
	public function dadosAction(){

		$model = new VendaModel();
		
		$where = null;
		
		if(isset($_REQUEST['filtros'])){
			$where = $_REQUEST['filtros'];
		}
		
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
			
			$codigo = $_REQUEST['id'];
			$this->atribuir('id', $codigo);
			$this->atribuir('hash', md5('sisnf'.$codigo));
			
		}
		
		$this->renderizar('vendaForm.tpl');
	}

	public function iniciarAction(){

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
			$this->atribuir('hash', md5('sisnf'.$codigo));
			
		}
		
		$this->renderizar('vendaIniciar.tpl');
	}

	public function pesquisarProdutoVendaAction(){
		
		$produtoModel = new VendaProdutoModel();
		
		$produtos = $produtoModel->pesquisar('id_venda = ' . (int) $_REQUEST['id']);
		
		if(count($produtos) > 0){
			print_r(json_encode(array_merge(array('error'=>0), array('produtos'=>$produtos))));
		}else{
			print_r(json_encode(array('error'=>1, 'msg'=>'Nenhum produto encontrado!')));
		}
				
	}
	
	public function pesquisarProdutoAction(){

		$produtoModel = new ProdutoModel();
		
		if($_REQUEST['id'] == 'all'){
			
			$produtos = $produtoModel->pesquisar();
			if(count($produtos) > 0){
				print_r(json_encode(array_merge(array('error'=>0), array('produtos'=>$produtos))));
			}else{
				print_r(json_encode(array('error'=>1, 'msg'=>'Produto inexistente!')));
			}
						
		}else{
			$produto = $produtoModel->pesquisar('id = ' . (int) $_REQUEST['id']);
			
			if(count($produto) > 0){
				print_r(json_encode(array_merge(array('error'=>0), current($produto))));
			}else{
				print_r(json_encode(array('error'=>1, 'msg'=>'Produto inexistente!')));
			}
			
		}
		
	}
	
	public function dadosFormAction(){
		
		$model = new VendaModel();
		
		$dados = array();
		
		if(!isset($_REQUEST['id'])){
			$codigo = $model->nextKey();
			
			$dados['codigo'] = $codigo;
			$dados['hash'] = md5('sisnf'.$codigo);
			
		} else { 
			$codigo = $_GET['id'];
			
			$registros = $model->pesquisar("id = {$_REQUEST['id']}");

			$dados['codigo'] = $_REQUEST['id'];
			$dados['hash'] = md5('sisnf'.$_REQUEST['id']);
			$dados['registros'] = current($registros);
		}
		
		print_r(json_encode($dados));
		
	}
	
	public function salvarAction(){

		if(!isset($_REQUEST['id']) || !isset($_REQUEST['hash'])){
			// [901] Erro de seguranca - Tentativa de alterar id manualmente
			print_r(json_encode(array('error'=>'1', 'msg'=>'Houve um erro ao tentar propressar os dados! Por favor tente novamente. Cod-901')));
			die();
		}
		
		if($_REQUEST['hash'] != md5('sisnf'.$_REQUEST['id'])){
			// [902] Erro de seguranca - Tentativa de alterar id manualmente
			print_r(json_encode(array('error'=>'1', 'msg'=>'Houve um erro ao tentar propressar os dados! Por favor tente novamente. Cod-902')));
			die();
		}
		
		$model = new VendaModel();

		$dados = $model->pesquisar("id = {$_REQUEST['id']}");
			
		unset($_REQUEST['hash']);

		if(count($dados) != 0){
			
			if($model->atualizar($_REQUEST, 'id')){
				// Registro atualizado
				print_r(json_encode(array('error'=>'0', 'msg'=>'Registro alterado com sucesso.')));
				die();
			}else{
				// [801] Erro de banco - Falha na tentativa de atualizar os dados
				print_r(json_encode(array('error'=>'1', 'msg'=>'Houve um erro ao tentar propressar os dados! Por favor tente novamente. Cod-801')));
				die();
			}
						
		}else{
			
			if($model->inserir($_REQUEST)){
				// Registro inserido
				print_r(json_encode(array('error'=>'0', 'msg'=>'Registro inserido com sucesso.')));
				die();
			}else{
				// [701] Erro de banco - Falha na tentativa de inserir os dados
				print_r(json_encode(array('error'=>'1', 'msg'=>'Houve um erro ao tentar propressar os dados! Por favor tente novamente. Cod-701')));
				die();
			}
					
		}
		
		die();	
	}
	
	public function finalizarVendaAction(){
		
		$venda = array();
		
		$venda['id'] = $_REQUEST['id'];
		$venda['forma_pagamento'] = $_REQUEST['forma_pagamento'];
		$venda['parcelas'] = $_REQUEST['parcelas'];
		$venda['data_venda'] = date('Y-m-d');
		$venda['valor'] = 0;
		
		$model = new VendaModel();
		$modelProduto = new VendaProdutoModel();
		
		$dados = $model->pesquisar("id = {$_REQUEST['id']}");
		
		unset($_REQUEST['id']);
		unset($_REQUEST['forma_pagamento']);
		unset($_REQUEST['parcelas']);
		
		$produtos = $_REQUEST;
		
		foreach($produtos as $produto){
			$venda['valor'] += $produto['qtd'] * $produto['preco_venda'];
		}
		
		if(count($dados) != 0){
			
			if($model->atualizar($venda, 'id')){
				
				$modelProduto->delete(array('id_venda'=>$venda['id']), 'id_venda');
				
				foreach($produtos as $produto){
					
					$modelProduto->inserir(array(
																		'id_venda'=>$venda['id'], 
																		'id_produto'=>$produto['id'], 
																		'nome_produto'=>$produto['produto'], 
																		'valor_produto'=>$produto['preco_venda'], 
																		'qtd_produto'=>$produto['qtd']
																		)
																 );
				}
				
				// Registro atualizado
				print_r(json_encode(array('error'=>'0', 'msg'=>'Registro alterado com sucesso.')));
				die();
			}else{
				// [801] Erro de banco - Falha na tentativa de atualizar os dados
				print_r(json_encode(array('error'=>'1', 'msg'=>'Houve um erro ao tentar propressar os dados! Por favor tente novamente. Cod-801')));
				die();
			}
						
		}else{
			
			if($model->inserir($venda)){
				// Registro inserido
				print_r(json_encode(array('error'=>'0', 'msg'=>'Registro inserido com sucesso.')));
				die();
			}else{
				// [701] Erro de banco - Falha na tentativa de inserir os dados
				print_r(json_encode(array('error'=>'1', 'msg'=>'Houve um erro ao tentar propressar os dados! Por favor tente novamente. Cod-701')));
				die();
			}
					
		}
		
		echo "<pre>";
		print_r($dados);
		echo "</pre>";
		die();
		
		echo "<pre>";
		print_r($_REQUEST);
		echo "</pre>";
		die();
	}
	
}