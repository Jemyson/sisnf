<?php

class LoginController extends Controller {
	
	public function indexAction(){
		$this->renderizar('login.tpl');
	}
	
	public function efetuarLoginAction(){
		
		$usuario		 = (isset($_REQUEST['login']) ? $_REQUEST['login'] : null);
		$senha  		 = (isset($_REQUEST['senha']) ? $_REQUEST['senha'] : null);

		$dadosUsuario = array();
		
		if($usuario == 'admin' && $senha == 'admin'){
			$dadosUsuario = array(array('id'=>1, 'nome'=>'Administrador'));
		}
		
		if(count($dadosUsuario) != 0){

			$usuario = current($dadosUsuario);

			$servidores = array(array('id_servidor'=>1, 'servidor'=>'principal'));

			if(count($servidores) != 0){

				foreach($servidores as $chave=>$valor){
					
					$servidores[$chave]['hash'] = md5('sistemap'.$valor['id_servidor']);
					
				}
				
				$usuario = current($dadosUsuario);
				
				if(count($servidores) == 1){
					
					$_SESSION['usuario']['tipo_login'] = 'logado';
					$_SESSION['usuario']['nome'] = 'Administrador SisNF';
					$_SESSION['servidor']['nome'] = 'Sistema de Nota Fistal';
					$_SESSION['funcionalidades'] = array();
					$_SESSION['chavesAcesso'] = array();
					
					header("Location: {$this->basePath()}index/index");
					die();
					
				}
				
			}else{

				header("Location: {$this->basePath()}login/index");
				die();
								
			}
			
		}

		header("Location: {$this->basePath()}login/index");
		die();
		
	}
	
	public function trocaBaseAction(){
		
		$usuarioModel = new UsuarioModel();

		$dadosUsuario = $usuarioModel->pesquisar("id = ".$_SESSION['usuario']['id']);

		if(count($dadosUsuario) != 0){

			$usuario = current($dadosUsuario);

			$usuarioServidorModel = new UsuarioServidorModel();
			
			$servidores = $usuarioServidorModel->pesquisarUsuarioServidor($usuario['id']);

			if(count($servidores) != 0){

				foreach($servidores as $chave=>$valor){
					
					$servidores[$chave]['hash'] = md5('sistemap'.$valor['id_servidor']);
					
				}
				
				$usuario = current($dadosUsuario);
				
				if(count($servidores) == 1){
					
					$usuario['tipo_login'] = 'logado';
					$_SESSION['usuario'] = $usuario;
					$_SESSION['servidor'] = current($servidores);
		
					$this->associarPermissaoUsuario($servidores[0]['id_servidor']);
					
					print_r(json_encode(array("success"=>"1", "url"=>"index/index")));
					die();
					
				}else{

					$usuario['tipo_login'] = 'selecionar_servidor';
					$_SESSION['usuario'] = $usuario;
					
					print_r(json_encode(array("success"=>"0", "url"=>"login/efetuarServidor", "servidores"=>$servidores)));
					die();
					
				}
				
			}else{

				print_r(json_encode(array("success"=>"-1", "msg"=>"Voc&ecirc; n&atilde;o possui nenhum servidor associado ao seu usu&aacute;rio")));
				die();
				
			}
			
		}
			
		print_r(json_encode(array("success"=>"-1", "msg"=>"Usu&aacute;rio ou Senha inv&aacute;lido.")));
		die();
	
	}
	
	public function efetuarServidorAction(){
		
		if(!isset($_REQUEST['id_servidor']) || !isset($_REQUEST['hash'])){
			// [901] Erro de seguranca - Tentativa de alterar id manualmente
			header("Location: {$this->basePath()}login/index");
			die();
		}
		
		if($_REQUEST['hash'] != md5('sistemap'.$_REQUEST['id_servidor'])){
			// [902] Erro de seguranca - Tentativa de alterar id manualmente
			header("Location: {$this->basePath()}login/index");
			die();
		}
		
		$_SESSION['usuario']['tipo_login'] = 'logado';
		
		$usuarioServidorModal = new UsuarioServidorModel();
		$servidores = $usuarioServidorModal->pesquisarUsuarioServidor($_SESSION['usuario']['id']);
		
		$erro = 1;
		
		foreach($servidores as $servidor){
			
			if($_REQUEST['id_servidor'] == $servidor['id_servidor']){

				$erro = 0;

				$servidorModel = new ServidorModel();
				
				$Dadosservidor = $servidorModel->pesquisar('id = '.$_REQUEST['id_servidor']);
				
				$_SESSION['servidor'] = current($Dadosservidor);
				
			}
			
		}
		
		/* Associar as permissoes do usuario */
		
		$this->associarPermissaoUsuario($_REQUEST['id_servidor']);
		
		if($erro != 0){
			$this->logoutAction();
		}

		header("Location: {$this->basePath()}index/index");
		die();
				
	}
	
	public function associarPermissaoUsuario($idServidor){
		
		$servidorModel = new ServidorModel();
		$dadosServidor = current($servidorModel->pesquisar('id = ' . $idServidor));
		
		$usuarioPerfilModel = new UsuarioPerfilModel();
		$perfilUsuario = $usuarioPerfilModel->pesquisar('id_usuario = '.$_SESSION['usuario']['id']);

		if(count($perfilUsuario) > 0){
			
			$funcionalidadePerfilModel = new FuncionalidadePerfilModel();
			$funcionalidades = $funcionalidadePerfilModel->pesquisar('id_perfil = '.$perfilUsuario[0]['id_perfil']);

			if(count($funcionalidades) > 0){
				
				$menuModel = new MenuModel();
				$menus = $menuModel->pesquisar(null, array('id', 'item'));
				
				$chaveMenu = array();
				
				foreach($menus as $menu){
					$chaveMenu[$menu['id']] = $menu;
				}

				$model = new FuncionalidadePerfilModel();
				$dadosFuncionalidades = $model->pesquisarPerfilMenu(null, array('id', 'nome', 'url'), 'ORDER BY nome ASC');
				
				$chaveFuncionalidade = array();
				
				$arrayFuncionalidades = array('2', '3', '4', '5', '6', '10', '12', '13', '14', '15', '17', '19', '20', '21', '25', '31', '33', '34', '37');
				
				foreach($dadosFuncionalidades as $funcionalidade){
					if($funcionalidade['sistema_novo'] == $dadosServidor['sistema_novo'] || in_array($funcionalidade['id'], $arrayFuncionalidades)){
						$chaveFuncionalidade[$funcionalidade['id']] = $funcionalidade;
					}
				}
				
				$arrayMenu = array();
				$arrayChave = array();
				
				foreach($funcionalidades as $funcionalidade){

					if(isset($chaveFuncionalidade[$funcionalidade['id_funcionalidade']])){
						
						$arrayChave[] = md5('sistemap'.$funcionalidade['id_funcionalidade']);
						
						if(!isset($arrayMenu[$chaveFuncionalidade[$funcionalidade['id_funcionalidade']]['id_menu']])){
							$arrayMenu[$chaveFuncionalidade[$funcionalidade['id_funcionalidade']]['id_menu']] = array('nome'=>$chaveMenu[$chaveFuncionalidade[$funcionalidade['id_funcionalidade']]['id_menu']]['item']);
						}
						
						$arrayMenu[$chaveFuncionalidade[$funcionalidade['id_funcionalidade']]['id_menu']]['item'][] = $chaveFuncionalidade[$funcionalidade['id_funcionalidade']];
						
					}
					
				}
				
				$_SESSION['acessoInterno'] = array('regional'=>$perfilUsuario[0]['id_regional'], 'subregional'=>$perfilUsuario[0]['id_subregional'], 'cambista'=>$perfilUsuario[0]['id_cambista']);
				$_SESSION['funcionalidades'] = $arrayMenu;
				$_SESSION['chavesAcesso'] = $arrayChave;
				
			}
			
		}

	}
	
	public function logoutAction() {

		unset($_SESSION['usuario']);
		session_destroy();
		header("Location: {$this->basePath()}login/index");
		die();
	}
		
}