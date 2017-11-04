<?php

require_once MODELS.'ConfigModel.php';

class ConfigController extends AppController{
	
	public function indexAction(){
		
		$this->renderizar('configForm.tpl');
		
	}
	
	public function dadosFormAction(){
		
		$model = new ConfigModel();
		
		$dados = array();
		
		$registros = $model->pesquisar();

		$dados['registros'] = current($registros);
		
		$dados['hash'] = md5('sisnf'.$dados['registros']['cnpj']);
		
		print_r(json_encode($dados));
		
	}
	
	public function salvarAction(){

		if(!isset($_REQUEST['cnpj']) || !isset($_REQUEST['hash'])){
			// [901] Erro de seguranca - Tentativa de alterar id manualmente
			print_r(json_encode(array('error'=>'1', 'msg'=>'Houve um erro ao tentar propressar os dados! Por favor tente novamente. Cod-901')));
			die();
		}
		
		if($_REQUEST['hash'] != md5('sisnf'.$_REQUEST['cnpj'])){
			// [902] Erro de seguranca - Tentativa de alterar id manualmente
			print_r(json_encode(array('error'=>'1', 'msg'=>'Houve um erro ao tentar propressar os dados! Por favor tente novamente. Cod-902')));
			die();
		}
		
		$model = new ConfigModel();

		$dados = $model->pesquisar("cnpj = '{$_REQUEST['cnpj']}'");
			
		unset($_REQUEST['hash']);

		if(count($dados) != 0){
			
			if($model->atualizar($_REQUEST, 'cnpj')){
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
	
	
}