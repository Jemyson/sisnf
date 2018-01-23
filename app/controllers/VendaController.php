<?php

require_once MODELS.'VendaModel.php';
require_once MODELS.'VendaProdutoModel.php';
require_once MODELS.'ProdutoModel.php';
require_once CONTROLLERS.'ClienteController.php';

class VendaController extends AppController{
	
	private static $_INICIADA = 1;
	private static $_AGUARDANDO = 2;
	private static $_FINALIZADA = 3;
	private static $_EMITIDA = 4;
	private static $_EXCLUIDA = 5;
	
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
			
			if($dados['status'] == '2'){
				$this->renderizar('vendaOrcamento.tpl');
			}else{
				$this->renderizar('vendaIniciar.tpl');
			}
			
		}
		
	}
	
	public function orcamentoAction(){

		$model = new VendaModel();
		
		$codigo = (int) $_REQUEST['id'];
		$dados = current($model->read('id = ' . $codigo));
		
		$this->atribuir('id', $codigo);
		$this->atribuir('idCliente', $dados['id_cliente']);
		$this->atribuir('hash', md5('sisnf'.$codigo));
		
		$this->renderizar('vendaOrcamento.tpl');
			
	}
	
	public function orcamentoPDFAction(){
		
		$model = new VendaModel();
		$produtoModel = new VendaProdutoModel();
		
		$codigo = (int) $_REQUEST['id_venda'];
		$dados = current($model->read('id = ' . $codigo));
		
		$produtos = $produtoModel->pesquisar('id_venda = ' . $codigo);
		
		//$orcamento = rand(10142, 19742);
		$orcamento = str_pad($codigo, 5, '0', STR_PAD_LEFT);
		
		$html = '<html>';
		$html .= '<head></head>';
		$html .= '<body>';
		$html .= '<div id="pdf">';
		$html .= '<p style="text-align: center; margin: 0px;"><img alt="" width="300px" src="img/logo-branco.png"></p>';
		$html .= '<p style="text-align: center; margin: 0px;">PRISMA AUDIO CENTER EIRELI - ME</p>';
		$html .= '<p style="text-align: center; margin: 0px;">28.801.726/0001-42</p>';
		$html .= '<p style="text-align: center; margin: 0px;">53530-480</p>';
		$html .= '<p style="text-align: center; margin: 0px;">Rua Cento e Noventa e Dois, 16</p>';
		$html .= '<p style="text-align: center; margin: 0px;">Caet&eacute;s I - Abreu e Lima | PE</p>';
		$html .= '<p style="text-align: center; margin: 0px;">(81) 99696-0347 / (81) 98713-7617</p>';
									
		$html .= '<p style="text-align: center; margin-top: 20px;">OR&Ccedil;AMENTO: '.$orcamento.'</p>';
		$html .= '<p style="text-align: center; margin: 0px;">'.implode("/",array_reverse(explode("-",$dados['data_venda']))).'</p>';
		
		if($_REQUEST['tipo'] == '1'){
			
			$html .= '<p style="margin-bottom: 10px; margin-top: 20px;">PRODUTOS</p>';
			
		}else{
			
			$html .= '<p style="margin-bottom: 10px; margin-top: 20px;">SERVI&Ccedil;OS</p>';
			
		}
		

		foreach($produtos as $produto){
			
			$html .= '<p style="border-top: 1px solid black; border-right: 1px solid black; border-left: 1px solid black; border-bottom: 0px solid black; padding: 5px; margin: 0px">';
			$html .= '<span>';
			$html .= $produto['qtd_produto'];
			$html .= ' - ';
			$html .= iconv('UTF-8', 'windows-1252', $produto['nome_produto']);
			$html .= '</span>';
			//$html .= '<span style="float: right">';
			$html .= '<span> - ';
			$html .= $produto['valor_produto'];
			$html .= '</span>';
			$html .= '</p>';
			
		}
		
		$total = $dados['valor'];
		
		$html .= '<p style="border: 1px solid black; padding: 5px; margin: 0px">';
		//$html .= '<span>&nbsp;</span>';
		$html .= '<span>Valor Total: '.$total.'</span>';
		//$html .= '<span style="float: right">Valor Total: '.$total.'</span>';
		$html .= '</p>';
									
		$html .= '<p style="margin-bottom: 10px; margin-top: 20px;">PAGAMENTO</p>';

		$formasPagamento = explode(';', $dados['forma_pagamento']);

		foreach($formasPagamento as $formaPagamento){
			
			$pagamento = explode(' - ', $formaPagamento);
			
			$html .= '<p style="border-top: 1px solid black; border-right: 1px solid black; border-left: 1px solid black; border-bottom: 0px solid black; padding: 5px; margin: 0px">';
			$html .= '<span>';
			$html .= str_replace('/', 'em', $pagamento[0]) . 'x';
			$html .= '</span>';
			//$html .= '<span style="float: right">';
			$html .= '<span> - ';
			$html .= $pagamento[1];
			$html .= '</span>';
			$html .= '</p>';
		
		}
		
		$html .= '<p style="border: 1px solid black; padding: 5px; margin: 0px">';
		$html .= '<span>Formas de Pagamento: ' . count($formasPagamento) . '</span>';
		$html .= '</p>';
		
		if($_REQUEST['tipo'] == '1'){
			
	    $html .= '<p>Entrega: de imediato ou 30 dias.</p>';
		
		}
		
		$html .= '</div>'; 
		$html .= '</body>';
		$html .= '</html>';
		
		require_once("lib/dompdf/dompdf_config.inc.php");
		spl_autoload_register('DOMPDF_autoload');
		function pdf_create($html, $filename, $paper, $orientation, $stream=TRUE)
		{
			$dompdf = new DOMPDF();
			$dompdf->set_paper($paper,$orientation);
			$dompdf->load_html($html);
			$dompdf->render();
			$dompdf->stream($filename.".pdf");
		}
		$filename = 'orcamento_' . $orcamento;
		$dompdf = new DOMPDF();
		//$html = file_get_contents('file_html.php'); 
		pdf_create($html,$filename,'A4','portrait');
		
		
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
		$filtros = array();
		
		if(isset($_REQUEST['id'])){
			
			$filtros['id'] = array('id = '. (int) $_REQUEST['id']);
			
			$produtos = $produtoModel->pesquisar($filtros);
			
			if(count($produtos) > 0){
				print_r(json_encode(array_merge(array('error'=>0), array('produtos'=>current($produtos)))));
			}else{
				print_r(json_encode(array('error'=>1, 'msg'=>'Produto inexistente!')));
			}
			
		}else{
			
			if($_REQUEST['idCategoria'] != '' && $_REQUEST['idCategoria'] > 0){
				$filtros['id_categoria'] = array('id_categoria = '. (int) $_REQUEST['idCategoria']);
			}
			if($_REQUEST['idSubcategoria'] != '' && $_REQUEST['idSubcategoria'] > 0){
				$filtros['id_subcategoria'] = array('id_subcategoria = ' . (int) $_REQUEST['idSubcategoria']);
			}
			if($_REQUEST['produto'] != ''){
				$filtros['nome'] = array("LOWER(nome) LIKE '%{$_REQUEST['produto']}%'");
			}
			
			$produtos = $produtoModel->pesquisar($filtros);
			
			if(count($produtos) > 0){
				print_r(json_encode(array_merge(array('error'=>0), array('produtos'=>$produtos))));
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

		$_REQUEST['status'] = self::$_INICIADA;
		
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
		
		$formaPagamento = array();
		
		$venda['id'] = $_REQUEST['id'];
		$venda['forma_pagamento'] = implode($_REQUEST['forma_pagamento'], ';');
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
			
			if($dados[0]['tipo'] == '1'){
				$venda['status'] = self::$_AGUARDANDO;
			}else{
				$venda['status'] = self::$_FINALIZADA;
			}
			
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
		
	}
	
	public function aprovarVendaAction(){
		
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

		$_REQUEST['tipo'] = 2;
		$_REQUEST['status'] = self::$_FINALIZADA;
		
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
						
		}
		
		die();	
		
	}
	
	public function excluirVendaAction(){

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

		$_REQUEST['status'] = self::$_EXCLUIDA;
		
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
						
		}
		
		die();	
		
	}
	
}