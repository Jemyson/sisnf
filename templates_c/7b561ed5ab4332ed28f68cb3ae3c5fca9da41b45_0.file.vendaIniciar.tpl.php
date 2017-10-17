<?php /* Smarty version 3.1.27, created on 2017-10-17 02:10:49
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/vendaIniciar.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:214366273759e590d94319e1_70861753%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b561ed5ab4332ed28f68cb3ae3c5fca9da41b45' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/vendaIniciar.tpl',
      1 => 1508217048,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '214366273759e590d94319e1_70861753',
  'variables' => 
  array (
    'id' => 0,
    'basePath' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_59e590d9496f48_50823342',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59e590d9496f48_50823342')) {
function content_59e590d9496f48_50823342 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '214366273759e590d94319e1_70861753';
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
							$('table tbody').append(htmlProduto);

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

			if(this.validarCampoObrigatorio()){

				$.ajax({
					type:'POST',
					global:true,
					url:_this.opcoes.urlSalvar,
					dataType:'json',
					data:$('#form').serialize(),
					success: function(data){

						if(data.error == 0){
							window.location = _this.opcoes.urlIniciar + '?id=' + _this.opcoes.id;
						}else{
							$('#divError').show();
							$('#divError').html(data.msg);
						}
						
					},
					error: function(){
					}
				});

			}else{

				alert("Os Campos em vermelho sao obrigatorios.");
				$('.btn-success').show();
				$('.disabled').hide();

			}
			
		}

	}

	var config = {};

	config.id						= '<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
';
	config.urlNova			= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/form';
	config.urlIniciar		= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/iniciar';
	config.urlProduto		= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/pesquisar-produto';
	config.urlSalvar		= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/salvar';

	$(document).ready(function(){

		venda = new Venda(config);

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
							        <label class="control-label">Or&ccedil;amento</label>
							    </div>							  
							  </div>							
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Cliente</label>
									<div class="col-sm-10">
							        <label class="control-label">Jemyson Vagner Rosa da Silva</label>
							    </div>							  
						    </div>		
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Endere&ccedil;o</label>
									<div class="col-sm-10">
							        <label class="control-label" style="font-weight: normal">Rua Maria Augusta de Fran&ccedil;a Ferreira</label>
							        <label class="control-label">Bairro</label>
							        <label class="control-label" style="font-weight: normal">Ouro Preto</label>
							        <label class="control-label">Cidade</label>
							        <label class="control-label" style="font-weight: normal">Olinda</label>
							    </div>							  
						    </div>		
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">CPF</label>
									<div class="col-sm-10">
							        <label class="control-label" style="font-weight: normal">097.328.164-22</label>
							        <label class="control-label">Fone</label>
							        <label class="control-label" style="font-weight: normal">(81) 99800-6555</label>
							        <label class="control-label">E-mail</label>
							        <label class="control-label" style="font-weight: normal">jemyson.vagner@gmail.com</label>
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
						
							<form>
								<!-- ADICIONAR PRODUTO -->
								<div id="divAdicionarProduto">
									<div class="row">
										<div class="form-group col-md-2" style="undefined">
											<label>Categoria*</label>
											<select class="form-control" id="id_categoria" name="id_categoria">
												<option>Selecione</option>
												<option>Audio</option>
												<option>Mixer</option>
												<option>Caixas</option>
											</select>
										</div>
										<div class="form-group col-md-3" style="undefined">
											<label>Produto*</label>
											<select class="form-control" id="id_produto" name="id_produto" obrigatorio="obrigatorio" entidade="entidade">
												<option value="0">Selecione</option>
												<option value="1">Placa M-audio</option>
												<option value="2">Controlador Behringer UMX610</option>
												<option value="3">Mesa Behringer X32</option>
											</select>
										</div>
										<div class="form-group col-md-1" style="undefined">
											<label>Qtd*</label>
											<input class="form-control" type="text" id="qtd" name="qtd" obrigatorio="obrigatorio"/>
										</div>
										<div class="form-group col-md-2" style="undefined">
											<label>&nbsp;</label>
											<br>
											<button type="button" class="btn btn-primary" onclick="venda.adicionarProduto()">Adicionar</button>
										</div>
									</div>
								</div>
								<!-- FORMA DE PAGAMENTO  -->
								<div id="divFormaPagamento" style="display: none">
									<div class="row">
										<div class="form-group col-md-2" style="undefined">
											<label>Forma de Pagamento*</label>
											<select class="form-control" id="pagamento" name="pagamento">
												<option>Selecione</option>
												<option>Boleto</option>
												<option>Cheque</option>
												<option>Cr&eacute;dito</option>
												<option>D&eacute;bito</option>
												<option>Dinheiro</option>
											</select>
										</div>
										<div class="form-group col-md-1" style="undefined">
											<label>Parcelas*</label>
											<select class="form-control" id="id_produto" name="parcelas">
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
											<button type="button" class="btn btn-success" onclick="venda.salvar()" style="width: 100px">Confirmar</button>
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
						
								<table class="table table-condensed table-striped">
								
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
										<!-- 
										<tr>
											<td style="text-align: center;"><a href="#"><i class="glyphicon glyphicon-trash"></i></a></td>
											<td>Mesa Behringer X32</td>
											<td style="text-align: right;">1</td>
											<td style="text-align: right;">15.500,00</td>
											<td style="text-align: right;">15.500,00</td>
											<td style="text-align: center;">n/d</td>
											<td style="text-align: center;"><a href="#"><i class="glyphicon glyphicon-usd" style="color: green"></i></a></td>
										</tr>
										<tr>
											<td style="text-align: center;"><a href="#"><i class="glyphicon glyphicon-trash"></i></a></td>
											<td>Controlador Behringer UMX610</td>
											<td style="text-align: right;">2</td>
											<td style="text-align: right;">999,00</td>
											<td style="text-align: right;">1.998,00</td>
											<td style="text-align: center;"><a href="#"><i class="glyphicon glyphicon-file" style="color: pink"></i></td>
											<td style="text-align: center;"><a href="#"><i class="glyphicon glyphicon-remove-sign" style="color: brown"></i></a></td>
										</tr>
										<tr>
											<td style="text-align: center;"><a href="#"><i class="glyphicon glyphicon-trash"></i></a></td>
											<td>Placa M-audio</td>
											<td style="text-align: right;">5</td>
											<td style="text-align: right;">450,00</td>
											<td style="text-align: right;">2.250,00</td>
											<td style="text-align: center;">n/d</td>
											<td style="text-align: center;"><a href="#"><i class="glyphicon glyphicon-usd" style="color: green"></i></a></td>
										</tr>
										 -->
									</tbody>
								
								</table>

							</form>
						
						</div>
						
					</div>
				
				</div>

			</div>		
		
		</div>
		
		






<?php echo $_smarty_tpl->getSubTemplate ("../../templates/base.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>