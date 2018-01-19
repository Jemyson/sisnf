<?php

require_once MODELS.'FornecedorModel.php';

class FornecedorController extends AppController{
	
	public function indexAction(){
		$this->renderizar('fornecedorGrid.tpl');
	}
	
	public function dadosAction(){

		$model = new FornecedorModel();
		
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

		if(isset($_GET['id'])){
			$this->atribuir('id', $_GET['id']);
		}
		
		$this->renderizar('fornecedorForm.tpl');
	}
	
	public function formVisualizarAction(){

		$this->atribuir('id', $_GET['id']);
		$this->atribuir('visualizar', '1');
		$this->renderizar('fornecedorForm.tpl');
	}
	
	public function dadosFormAction(){
		
		$model = new FornecedorModel();
		
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
		
		$model = new FornecedorModel();

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
	
	public function dadosEntidade(){
		$model = new FornecedorModel();
		
		$dados = $model->pesquisar(null, array('id', 'nome AS valor')); 
		
		$dadosSaida = array();
		
		foreach($dados as $valor){
			$dadosSaida[$valor['id']] = $valor['valor'];
		}
		
		return json_encode($dadosSaida);
	}
	
	public function dadosEntidadeAction(){
		$model = new FornecedorModel();
		
		$dados = $model->pesquisar(null, array('id', 'nome AS valor')); 
		
		$dadosSaida = array();
		
		foreach($dados as $valor){
			$dadosSaida[$valor['id']] = $valor['valor'];
		}
		
		print_r(json_encode($dadosSaida));
		die();
		
	}
	
}