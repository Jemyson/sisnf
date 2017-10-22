<?php /* Smarty version 3.1.27, created on 2017-10-21 23:43:33
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/vendaIniciar.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:156066529759ec05d5c4fe82_43513873%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b561ed5ab4332ed28f68cb3ae3c5fca9da41b45' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/vendaIniciar.tpl',
      1 => 1508640212,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '156066529759ec05d5c4fe82_43513873',
  'variables' => 
  array (
    'id' => 0,
    'idCliente' => 0,
    'basePath' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_59ec05d5caac76_92352746',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59ec05d5caac76_92352746')) {
function content_59ec05d5caac76_92352746 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '156066529759ec05d5c4fe82_43513873';
echo $_smarty_tpl->getSubTemplate ("../../templates/topo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




	<style>
	
		.form-group {
    	margin-bottom: 0px;
    	padding-right: 0px;
		}
		.control-label {
			padding-right: 0px;
		}
	
	</style>

	<?php echo '<script'; ?>
 type="text/javascript" language="javascript">

	Venda = function(opcoes){

		this.opcoes = opcoes;
		this.produtos = {};

		this.nova = function(){
			window.location = this.opcoes.urlNova;
		}

		this.carregarVenda = function(){

			var _this = this;

			$.ajax({
				type:'POST',
				global:true,
				url:_this.opcoes.urlDadosVenda + '?id=' + _this.opcoes.id,
				dataType:'json',
				data:'',
				success: function(data){

					if(data.registros.tipo == 1){
						$('#tipo').html('Or&ccedil;amento');
					}else{
						$('#tipo').html('Venda');
					}
					
					
				},
				error: function(){
				}
			});

		}
		
		this.carregarCliente = function(){

			var _this = this;

			$.ajax({
				type:'POST',
				global:true,
				url:_this.opcoes.urlCliente + '?id=' + _this.opcoes.idCliente,
				dataType:'json',
				data:'',
				success: function(data){

					$('#labelCliente').html(data.registros.nome);
					$('#labelEndereco').html(data.registros.endereco);
					$('#labelBairro').html(data.registros.bairro);
					$('#labelCidade').html(data.registros.cidade);
					$('#labelCPF').html(data.registros.cpf);
					$('#labelTelefone').html(data.registros.celular);
					$('#labelEmail').html(data.registros.email);
					
				},
				error: function(){
				}
			});
			
		}

		this.carregarCategoria = function(){

			var _this = this;

			$.ajax({
				type:'POST',
				global:true,
				url:_this.opcoes.urlCategoria,
				dataType:'json',
				data:'',
				success: function(data){

					var htmlCategoria = '<option value="0">Selecione</option>';
					for(var chave in data){

						htmlCategoria += '<option value="'+data[chave].id+'">'+data[chave].valor+'</option>';

					}
					
					$('#id_categoria').html(htmlCategoria);
					
				},
				error: function(){
				}
			});
			
		}

		this.carregarProdutosVenda = function(){

			var _this = this;
			
			$.ajax({
				type:'POST',
				global:true,
				url:_this.opcoes.urlProdutoVenda,
				dataType:'json',
				data:'id='+_this.opcoes.id,
				success: function(data){
				
					if(data.error == 0){

						for(var chave in data.produtos){
						
							var htmlProduto = '';

							htmlProduto += '<tr id="produto_'+data.produtos[chave].id_produto+'">';
							htmlProduto += '<td style="text-align: center;"><a href="javascript:venda.removerProduto('+data.produtos[chave].id_produto+')"><i class="glyphicon glyphicon-trash"></i></a></td>';
							htmlProduto += '<td>'+data.produtos[chave].nome_produto+'</td>';
							htmlProduto += '<td style="text-align: right;">'+data.produtos[chave].qtd_produto+'</td>';
							htmlProduto += '<td style="text-align: right;">'+Formatter.moeda(data.produtos[chave].valor_produto, 2,',','.')+'</td>';
							htmlProduto += '<td style="text-align: right;">'+Formatter.moeda((data.produtos[chave].valor_produto * data.produtos[chave].qtd_produto), 2,',','.')+'</td>';
							htmlProduto += '<td style="text-align: center;">n/d</td>';
							htmlProduto += '<td style="text-align: center;"><a href="#"><i class="glyphicon glyphicon-usd" style="color: green"></i></a></td>';
							htmlProduto += '</tr>';
	
							_this.produtos[data.produtos[chave].id_produto] = {'id':data.produtos[chave].id_produto, 'produto':data.produtos[chave].nome_produto, 'preco_venda':data.produtos[chave].valor_produto, 'qtd':data.produtos[chave].qtd_produto};
							$('#tabelaProdutosVenda tbody').append(htmlProduto);
							
						}

						_this.atualizarQtdProdutos();
						_this.calcularRetornoPossivel();
						
						
					}

				}

			});
			
		}
		
		this.validarCampoObrigatorio = function(){
			var erro = 0;
			
			$('input[obrigatorio=obrigatorio]').each(function(){
				
				if(!App.isset($(this).val()) || $(this).val() == ''){
					erro = 1;
					$(this).parent().addClass( "has-error" );
					$(this).parent().css("color", "#b94a48");
				}else{
					$(this).parent().removeClass( "has-error" );
					$(this).parent().css("color", "");
				}
				
			});
			
			$('select[obrigatorio=obrigatorio]').each(function(){
				
				if(!App.isset($(this).val()) || $(this).val() == '-1' || ($(this).val() == '0' && App.isset($(this).attr('entidade')) )){
					erro = 1;
					$(this).parent().addClass( "has-error" );
					$(this).parent().css("color", "#b94a48");
				}else{
					$(this).parent().removeClass( "has-error" );
					$(this).parent().css("color", "");
				}
				
			});
			
			if(erro != 0){
				return false;
			}else{
				return true;
			}
			
		}

		this.atualizarQtdProdutos = function(){
			if(App.count(this.produtos) == 1){
				$("#qtdProdutos").html(App.count(this.produtos) + ' item');
			}else{
				$("#qtdProdutos").html(App.count(this.produtos) + ' itens');
			}
			if(App.count(this.produtos) > 0){
				$('#btnFinalizarVenda').removeAttr('disabled');
			}else{
				$('#btnFinalizarVenda').attr('disabled', 'disabled');
			}
		}

		this.carregarProdutos = function(){

			var _this = this;

			$('#modalPesquisarProduto').modal();

			var filtros = {};
			filtros['idCategoria'] = $('#id_categoria').val();
			filtros['idSubcategoria'] = $('#id_subcategoria').val();
			filtros['produto'] = $('#produto').val().toLowerCase();
			
			$.ajax({
				type:'POST',
				global:true,
				url:_this.opcoes.urlProduto,
				dataType:'json',
				data:filtros,
				success: function(data){

					if(data.error == 0){

						console.log(data.produtos);
						
						var tabelaProdutos = '';
						for(var chave in data.produtos){

							tabelaProdutos += '<tr>';
							tabelaProdutos += '<td style="text-align: center;"><input type="radio" id="produto[]" name="produto[]" value="'+data.produtos[chave].id+'" /></td>';
							tabelaProdutos += '<td>'+data.produtos[chave].nome+'</td>';
							tabelaProdutos += '<td style="text-align: right;">1</td>';
							tabelaProdutos += '<td style="text-align: right;">'+Formatter.moeda(data.produtos[chave].preco_venda, 2,',','.')+'</td>';
							tabelaProdutos += '<td style="text-align: right;">'+Formatter.moeda((data.produtos[chave].preco_venda * 1), 2,',','.')+'</td>';
							tabelaProdutos += '</tr>';
							
						}
						
						$('#tabelaPesquisarProdutos tbody').html(tabelaProdutos);
						
					}

				}

			});
						
		}

		this.adicionarProduto = function(){

			_this = this;
			
			var id_produto 	= $('#id_produto').val();
			var qtd					= $('#qtd').val();	

			if(this.validarCampoObrigatorio()){
			
				htmlProduto  = '';
				$.ajax({
					type:'POST',
					global:true,
					url:_this.opcoes.urlProduto,
					dataType:'json',
					data:'id='+id_produto,
					success: function(data){
	
						if(data.error == 0){
	
							$('#produto_'+data.id).remove();
							
							if(_this.produtos.hasOwnProperty(data.id)){
								delete _this.produtos[data.id];
							}
							
							htmlProduto += '<tr id="produto_'+data.id+'">';
							htmlProduto += '<td style="text-align: center;"><a href="javascript:venda.removerProduto('+data.id+')"><i class="glyphicon glyphicon-trash"></i></a></td>';
							htmlProduto += '<td>'+data.nome+'</td>';
							htmlProduto += '<td style="text-align: right;">'+qtd+'</td>';
							htmlProduto += '<td style="text-align: right;">'+Formatter.moeda(data.preco_venda, 2,',','.')+'</td>';
							htmlProduto += '<td style="text-align: right;">'+Formatter.moeda((data.preco_venda * qtd), 2,',','.')+'</td>';
							htmlProduto += '<td style="text-align: center;">n/d</td>';
							htmlProduto += '<td style="text-align: center;"><a href="#"><i class="glyphicon glyphicon-usd" style="color: green"></i></a></td>';
							htmlProduto += '</tr>';
	
							_this.produtos[data.id] = {'id':data.id, 'produto':data.nome, 'preco_venda':data.preco_venda, 'qtd':qtd};
	
							_this.atualizarQtdProdutos();
							_this.calcularRetornoPossivel();
							$('#tabelaProdutosVenda tbody').append(htmlProduto);

							}else{
								alert(data.msg);

							}
						

						},

					error: function(){

						}

					});

				}else{
					alert("Os Campos em vermelho sao obrigatorios.");
				}

		}

			
		this.removerProduto = function(id){

			delete this.produtos[id];
			
			$('#produto_'+id).remove();

			this.atualizarQtdProdutos();
			this.calcularRetornoPossivel();
			
		}

		this.calcularRetornoPossivel = function(){

			var _this = this;
			
			var retornoPossivel = 0;

			for(var produto in this.produtos){
				retornoPossivel = parseFloat(retornoPossivel) + this.produtos[produto].qtd * parseFloat(this.produtos[produto].preco_venda);
				console.log(retornoPossivel);
			}

			$('#valorProdutos').html('&nbsp;' + Formatter.moeda(retornoPossivel, 2,',','.'));
			
		}

		this.finalizarVenda = function(){

			$('#btnFinalizarVenda').attr('disabled', 'disabled');
			$('#divFormaPagamento').show();
			$('#divAdicionarProduto').hide();
			
		}

		this.continuarVenda = function(){

			$('#btnFinalizarVenda').removeAttr('disabled');
			$('#divFormaPagamento').hide();
			$('#divAdicionarProduto').show();
			
		}
		
		this.salvar = function(){

			var _this = this;

			var venda = {};

			for(var produto in this.produtos){
				venda[produto] = _this.produtos[produto];
			}

			venda['id'] = _this.opcoes.id;
			venda['forma_pagamento'] = $('#pagamento').val();
			venda['parcelas'] = $('#parcelas').val();
			
			$.ajax({
				type:'POST',
				global:true,
				url:_this.opcoes.urlSalvar,
				dataType:'json',
				data:venda,
				success: function(data){

					if(data.error == 0){
						window.location = _this.opcoes.urlVenda;
					}else{
						$('#divError').show();
						$('#divError').html(data.msg);
					}
					
				},
				error: function(){
				}
			});

			
		}

	}

	var config = {};

	config.id								= '<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
';
	config.idCliente				= '<?php echo $_smarty_tpl->tpl_vars['idCliente']->value;?>
';
	config.urlDadosVenda		= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/dados-form';
	config.urlCliente				= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
cliente/dados-form';
	config.urlVenda 				= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda';
	config.urlCategoria			= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
categoria/dados-entidade';
	config.urlNova					= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/form';
	config.urlIniciar				= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/iniciar';
	config.urlProduto				= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/pesquisar-produto';
	config.urlProdutoVenda	= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/pesquisar-produto-venda';
	config.urlSalvar				= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/finalizar-venda';

	$(document).ready(function(){

		venda = new Venda(config);
		venda.carregarVenda();
		venda.carregarCliente();
		venda.carregarCategoria();
		//venda.carregarProdutos();
		venda.carregarProdutosVenda();

	});	
			
	<?php echo '</script'; ?>
>

	
		<div class="page-wrapper">
		
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"><a href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda">Vendas</a> / Cadastro</h1>
				</div>
			</div>	
		
			<div class="row">

				<div class="col-lg-12">
				
					<div class="panel panel-default">
					
						<div class="panel-heading">
							<a class="pull-right btn btn-primary btn-xs" href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda">
								Voltar  <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
							</a>Novo Registro: <?php echo $_smarty_tpl->tpl_vars['id']->value;?>

						</div>
					
						<div class="panel-body" id="divHTML">
						
							<h3 style="margin-top: 0px">Dados da Venda</h3>
							<hr>
						
							<form class="form-horizontal">
							
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Tipo</label>
									<div class="col-sm-10">
							        <label class="control-label" id="tipo">Or&ccedil;amento</label>
							    </div>							  
							  </div>							
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Cliente</label>
									<div class="col-sm-10">
							        <label class="control-label" id="labelCliente" name="labelCliente"></label>
							    </div>							  
						    </div>		
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Endere&ccedil;o</label>
									<div class="col-sm-10">
							        <label class="control-label" style="font-weight: normal" id="labelEndereco" name="labelEndereco"></label>
							        <label class="control-label">Bairro</label>
							        <label class="control-label" style="font-weight: normal" id="labelBairro" name="labelBairro"></label>
							        <label class="control-label">Cidade</label>
							        <label class="control-label" style="font-weight: normal" id="labelCidade" name="labelCidade"></label>
							    </div>							  
						    </div>		
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">CPF</label>
									<div class="col-sm-10">
							        <label class="control-label" style="font-weight: normal" id="labelCPF" name="labelCPF"></label>
							        <label class="control-label">Fone</label>
							        <label class="control-label" style="font-weight: normal"  id="labelTelefone" name="labelTelefone"></label>
							        <label class="control-label">E-mail</label>
							        <label class="control-label" style="font-weight: normal" id="labelEmail" name="labelEmail"></label>
							    </div>							  
						    </div>		
							  <div class="form-group" style="margin-top: 15px">
							    <div class="col-sm-offset-2 col-sm-10">
							      <button type="button" style="width: 120px" class="btn btn-primary" disabled="disabled" >Iniciar Venda</button>
							      <button type="button" style="width: 120px" class="btn btn-success" disabled="disabled" onclick="javascript:venda.finalizarVenda()" id="btnFinalizarVenda">Finalizar Venda</button>
							      <button type="button" style="width: 120px" class="btn btn-danger" disabled="disabled">Excluir Venda</button>
							      <button type="button" style="width: 120px" class="btn btn-warning" onclick="venda.nova()" >Nova Venda</button>
							    </div>
							  </div>					
							
							</form>
						
							<h3 style="#margin-top: 0px"><span id="qtdProdutos">0 itens</span> / Total R$ <span id="valorProdutos">0,00</span></h3>
							<hr>
						
							<form action="teste" method="post" id="formAdicionarProduto" name="formAdicionarProduto">
								<!-- ADICIONAR PRODUTO -->
								<div id="divAdicionarProduto">
									<div class="row">
										<div class="form-group col-md-2">
											<label>Categoria</label>
											<select class="form-control" id="id_categoria" name="id_categoria">
											</select>
										</div>
										<div class="form-group col-md-2">
											<label>Sub-Categoria</label>
											<select class="form-control" id="id_subcategoria" name="id_subcategoria">
											</select>
										</div>
										<div class="form-group col-md-3">
											<label>Produto</label>
											<input type="text" class="form-control" id="produto" name="produto" />
										</div>
										<div class="form-group col-md-1" style="display: none">
											<label>Qtd</label>
											<input class="form-control" type="text" id="qtd" name="qtd" />
										</div>
										<div class="form-group col-md-2" style="undefined">
											<label>&nbsp;</label>
											<br>
											<button type="button" class="btn btn-primary" onclick="venda.adicionarProduto()" style="display: none">Adicionar</button>
											<button type="button" class="btn btn-primary" onclick="venda.carregarProdutos()">Pesquisar</button>
										</div>
									</div>
								</div>
							</form>
							<form>
								<!-- FORMA DE PAGAMENTO  -->
								<div id="divFormaPagamento" style="display: none">
									<div class="row">
										<div class="form-group col-md-2" style="undefined">
											<label>Forma de Pagamento*</label>
											<select class="form-control" id="pagamento" name="pagamento">
												<option value="0">Selecione</option>
												<option value="boleto">Boleto</option>
												<option value="cheque">Cheque</option>
												<option value="credito">Cr&eacute;dito</option>
												<option value="debito">D&eacute;bito</option>
												<option value="dinheiro">Dinheiro</option>
											</select>
										</div>
										<div class="form-group col-md-1" style="undefined">
											<label>Parcelas*</label>
											<select class="form-control" id="parcelas" name="parcelas">
												<option value="0">Selecione</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
											</select>
										</div>
										<div class="form-group col-md-1" style="undefined">
											<label>&nbsp;</label>
											<br>
											<button type="button" class="btn btn-success" onclick="venda.salvar()" style="width: 93px">Confirmar</button>
										</div>
										<div class="form-group col-md-1" style="undefined">
											<label>&nbsp;</label>
											<br>
											<button type="button" class="btn btn-info" onclick="venda.continuarVenda()" style="width: 130px">Continuar venda</button>
										</div>
									</div>
								</div>
							
						
								<br>
								<br>
						
								<table id="tabelaProdutosVenda" class="table table-condensed table-striped">
								
									<thead>
										<tr>
											<th style="text-align: center"></th>
											<th style="text-align: center">Produto</th>
											<th style="text-align: center">Qtd</th>
											<th style="text-align: center">Val unit</th>
											<th style="text-align: center">Total</th>
											<th style="text-align: center">Tributo</th>
											<th style="text-align: center">A&ccedil;&otilde;es</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								
								</table>

							</form>
						
						</div>
						
					</div>
				
				</div>

			</div>		
		
		</div>
		
		<div class="modal fade" tabindex="-1" role="dialog" id="modalPesquisarProduto">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Pesquisar Produtos</h4>
		      </div>
		      <div class="modal-body">
		        <p>Selecione o produto:</p>
						<table id="tabelaPesquisarProdutos" class="table table-condensed table-striped">
						
							<thead>
								<tr>
									<th style="text-align: center"></th>
									<th style="text-align: center">Produto</th>
									<th style="text-align: center">Qtd</th>
									<th style="text-align: center">Val unit</th>
									<th style="text-align: center">Total</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						
						</table>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        <button type="button" class="btn btn-primary">Adicionar</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		






<?php echo $_smarty_tpl->getSubTemplate ("../../templates/base.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>