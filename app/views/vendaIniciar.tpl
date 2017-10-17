{include file="../../templates/topo.tpl"}

{literal}

	<style>
	
		.form-group {
    	margin-bottom: 0px;
    	padding-right: 0px;
		}
		.control-label {
			padding-right: 0px;
		}
	
	</style>

	<script type="text/javascript" language="javascript">

	Venda = function(opcoes){

		this.opcoes = opcoes;
		this.produtos = {};

		this.nova = function(){
			window.location = this.opcoes.urlNova;
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
							$('table tbody').append(htmlProduto);
							
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
			
			$.ajax({
				type:'POST',
				global:true,
				url:_this.opcoes.urlProduto,
				dataType:'json',
				data:'id=all',
				success: function(data){

					if(data.error == 0){

						$('#id_produto');

						var htmlProdutos = '<option value="0">Selecione</option>';
						for(var chave in data.produtos){

							htmlProdutos += '<option value="'+data.produtos[chave].id+'">'+data.produtos[chave].nome+'</option>';
						}
						
						$('#id_produto').html(htmlProdutos);
						
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

	config.id								= '{/literal}{$id}{literal}';
	config.urlVenda 				= '{/literal}{$basePath}{literal}venda/grid';
	config.urlNova					= '{/literal}{$basePath}{literal}venda/form';
	config.urlIniciar				= '{/literal}{$basePath}{literal}venda/iniciar';
	config.urlProduto				= '{/literal}{$basePath}{literal}venda/pesquisar-produto';
	config.urlProdutoVenda	= '{/literal}{$basePath}{literal}venda/pesquisar-produto-venda';
	config.urlSalvar				= '{/literal}{$basePath}{literal}venda/finalizar-venda';

	$(document).ready(function(){

		venda = new Venda(config);
		venda.carregarProdutos();
		venda.carregarProdutosVenda();

	});	
			
	</script>
{/literal}
	
		<div class="page-wrapper">
		
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"><a href="{$basePath}venda">Vendas</a> / Cadastro</h1>
				</div>
			</div>	
		
			<div class="row">

				<div class="col-lg-12">
				
					<div class="panel panel-default">
					
						<div class="panel-heading">
							<a class="pull-right btn btn-primary btn-xs" href="{$basePath}venda">
								Voltar  <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
							</a>Novo Registro: {$id}
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
										<div class="form-group col-md-2" style="display: none">
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
		
		






{include file="../../templates/base.tpl"}