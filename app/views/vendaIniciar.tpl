<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>

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
		this.valorVenda = 0;
		this.formaPagamento = {};
		this.codFormaPagamento = 1;
		this.valorRestante = 0;
		
		this.nova = function(){
			window.location = this.opcoes.urlNova;
		}

		this.transmitirVenda = function(){
			$('#processando').show();
			$('#erroAlerta').hide();
			$('#loading').show();
			$('#alerta').hide();
			$('#modalTransmitir').modal();

			var _this = this;
			
			$.ajax({
				type:'POST',
				global:true,
				url:_this.opcoes.urlNotaFiscal + '/emitir?id_venda=' + _this.opcoes.id + '&id_cliente=' + _this.opcoes.idCliente,
				dataType:'json',
				data:'',
				success: function(data){

					if(data.error == 0){
						window.location = _this.opcoes.urlNotaFiscal + '/form?id=' + _this.opcoes.id;
					}else{

						$('#erroAlerta').html(data.msg);
						$('#loading').hide();
						$('#alerta').show();
						$('#processando').hide();
						$('#erroAlerta').show();

					}
					
				},
				error: function(){
				}
			});

			
			setTimeout(function(){
			    //do what you need here
			}, 5000);
			
			
		}

		this.excluirVenda = function(){

			var _this = this;
			
			$.ajax({
				type:'POST',
				global:true,
				url:_this.opcoes.urlExcluir + '?id=' + _this.opcoes.id + '&hash=' + _this.opcoes.hash,
				dataType:'json',
				data:'',
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

		}

		this.aprovarVenda = function(){

			var _this = this;
			
			$.ajax({
				type:'POST',
				global:true,
				url:_this.opcoes.urlAprovar + '?id=' + _this.opcoes.id + '&hash=' + _this.opcoes.hash,
				dataType:'json',
				data:'',
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

					_this.opcoes.hash = data.hash;
					
					if(data.registros.tipo == 1){
						$('#tipo').html('Or&ccedil;amento');
					}else{
						$('#tipo').html('Venda');
					}

					if(App.isset(data.registros.forma_pagamento) && data.registros.forma_pagamento != ''){

						var formaPagamento = data.registros.forma_pagamento.split(';');

						for(var chave in formaPagamento){

							var id = _this.codFormaPagamento;
							var tipo = formaPagamento[chave].split(' / ');
							var parcelas = tipo[1].split(' - ');
							var valor = parcelas[1];
									
							_this.formaPagamento[id] = {'tipo':tipo[0], 'parcelas':parcelas[0], 'valor': Formatter.converteMoedaFloat(valor)};
							
							_this.atualizarQtdPagamento();
							_this.calcularValorRestante();

							$('#divFormasPagamento').append('<p id="formaPagamento_'+id+'">Tipo: ' + tipo[0] + ' Parcelas: ' + parcelas[0] + ' Valor:' + valor + '</p>');

							_this.codFormaPagamento++;

						}
						
					}

					if(data.registros.status == 1){
						$('#tipo').html($('#tipo').html() + ' [ Venda Iniciada ]');
					}else if(data.registros.status == 2){
						$('#tipo').html($('#tipo').html() + ' [ Venda Aguardando ]');
						$('#formAdicionarProduto').hide();
						$('#btnPagamento').hide();
						$('#btnFinalizarVenda').hide();
						$('#btnAprovar').show();
						$('#btnExcluir').show();
					}else if(data.registros.status == 3){
						$('#tipo').html($('#tipo').html() + ' [ Venda Finalizada ]');
						$('#formAdicionarProduto').hide();
						$('#btnPagamento').hide();
						$('#btnFinalizarVenda').hide();
						$('#btnTransmitir').show();
						$('#btnExcluir').show();
					}else if(data.registros.status == 4){
						$('#tipo').html($('#tipo').html() + ' [ Venda Transmitida ]');
						$('#formAdicionarProduto').hide();
						$('#btnPagamento').hide();
						$('#btnFinalizarVenda').hide();
					}else if(data.registros.status == 5){
						$('#tipo').html($('#tipo').html() + ' [ Venda Excluida ]');
						$('#formAdicionarProduto').hide();
						$('#btnPagamento').hide();
						$('#btnFinalizarVenda').hide();
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

		this.carregarSubcategoria = function(){

			var _this = this;

			if($('#id_categoria').val() == '0'){

				var htmlSubcategoria = '<option value="0">Categoria n&atilde;o informado(a)</option>';
				
				$('#id_subcategoria').html(htmlSubcategoria);
				
			}else{
				
				$.ajax({
					type:'POST',
					global:true,
					url:_this.opcoes.urlSubcategoria,
					dataType:'json',
					data:'valorPai='+$('#id_categoria').val(),
					success: function(data){
	
						var htmlSubcategoria = '<option value="0">Selecione</option>';
						for(var chave in data){
	
							htmlSubcategoria += '<option value="'+data[chave].id+'">'+data[chave].valor+'</option>';
	
						}
						
						$('#id_subcategoria').html(htmlSubcategoria);
						
					},
					error: function(){
					}
				});

			}
			
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
		
		this.validarCampoObrigatorio = function(form){
			var erro = 0;
			
			$('#' + form + ' input[obrigatorio=obrigatorio]').each(function(){
				
				if(!App.isset($(this).val()) || $(this).val() == ''){
					erro = 1;
					$(this).parent().addClass( "has-error" );
					$(this).parent().css("color", "#b94a48");
				}else{
					$(this).parent().removeClass( "has-error" );
					$(this).parent().css("color", "");
				}
				
			});

			console.log('#' + form + ' select[obrigatorio=obrigatorio]');
			
			$('#' + form + ' select[obrigatorio=obrigatorio]').each(function(){
				
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
				$('#btnPagamento').removeAttr('disabled');
			}else{
				$('#btnPagamento').attr('disabled', 'disabled');
			}
		}

		this.carregarProdutos = function(){

			var _this = this;

			$('#qtdProduto').val('');
			$('#qtdProduto').attr('disabled', 'disabled');
			$('#valorProduto').val('');
			
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

						var tabelaProdutos = '';
						for(var chave in data.produtos){

							tabelaProdutos += '<tr>';
							tabelaProdutos += '<td style="text-align: center;"><input type="radio" id="radioProduto" name="radioProduto" value="'+data.produtos[chave].id+'" onclick="javascript:venda.selecionarProduto()" /></td>';
							tabelaProdutos += '<td>'+data.produtos[chave].nome+'</td>';
							tabelaProdutos += '<td style="text-align: right;">1</td>';
							tabelaProdutos += '<td style="text-align: right;">'+Formatter.moeda(data.produtos[chave].preco_venda, 2,',','.')+'</td>';
							//tabelaProdutos += '<td style="text-align: right;">'+Formatter.moeda((data.produtos[chave].preco_venda * 1), 2,',','.')+'</td>';
							tabelaProdutos += '</tr>';
							
						}
						
						$('#tabelaPesquisarProdutos tbody').html(tabelaProdutos);
						
					}

				}

			});
						
		}

		this.selecionarProduto = function(){

			$('#qtdProduto').removeAttr('disabled');
			$('#qtdProduto').val('1');
			$('#qtdProduto').focus();
			this.calcularValorProduto();
			
		}

		this.calcularValorProduto = function(){

			var _this = this;
			
			var idProdutoSelecionado = $("input[name='radioProduto']:checked").val();
			var qtdProduto = $("#qtdProduto").val();
			
			$.ajax({
				type:'POST',
				global:true,
				url:_this.opcoes.urlProduto,
				dataType:'json',
				data:'id='+idProdutoSelecionado,
				success: function(data){

					var produto = data.produtos;

					$('#valorProduto').val(Formatter.moeda((qtdProduto * produto.preco_venda), 2,',','.'));
					
					console.log(data);
				
				}

			});
			
		}

		this.aplicarDesconto = function(){

			if($('#permitirDesconto').prop("checked")){
				$('#valorProduto').removeAttr('disabled');
				$('#valorProduto').focus();
			}else{
				$('#valorProduto').attr('disabled', 'disabled');
				this.calcularValorProduto();
			}
		}

		this.adicionarProduto = function(){

			_this = this;
			
			var id_produto 		= $("input[name='radioProduto']:checked").val();
			var qtd						= $('#qtdProduto').val();	
			var valorProduto	= $('#valorProduto').val();
			
			if(this.validarCampoObrigatorio('formPesquisarProduto')){
			
				htmlProduto  = '';
				$.ajax({
					type:'POST',
					global:true,
					url:_this.opcoes.urlProduto,
					dataType:'json',
					data:'id='+id_produto,
					success: function(data){
	
						if(data.error == 0){

							var produto = data.produtos;
							
							$('#produto_'+produto.id).remove();
							
							if(_this.produtos.hasOwnProperty(produto.id)){
								delete _this.produtos[produto.id];
							}
							
							htmlProduto += '<tr id="produto_'+produto.id+'">';
							htmlProduto += '<td style="text-align: center;"><a href="javascript:venda.removerProduto('+produto.id+')"><i class="glyphicon glyphicon-trash"></i></a></td>';
							htmlProduto += '<td>'+produto.nome+'</td>';
							htmlProduto += '<td style="text-align: right;">'+qtd+'</td>';
							htmlProduto += '<td style="text-align: right;">'+Formatter.moeda(produto.preco_venda, 2,',','.')+'</td>';
							htmlProduto += '<td style="text-align: right;">'+Formatter.moeda((produto.preco_venda * qtd), 2,',','.')+'</td>';
							htmlProduto += '<td style="text-align: center;">n/d</td>';
							htmlProduto += '<td style="text-align: center;"><a href="#"><i class="glyphicon glyphicon-usd" style="color: green"></i></a></td>';
							htmlProduto += '</tr>';
	
							_this.produtos[produto.id] = {'id':produto.id, 'produto':produto.nome, 'preco_venda':produto.preco_venda, 'qtd':qtd};
	
							_this.atualizarQtdProdutos();
							_this.calcularRetornoPossivel();
							$('#tabelaProdutosVenda tbody').append(htmlProduto);

							$('#modalPesquisarProduto').modal('hide');

							$('#produto').focus();
							
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
			}

			_this.valorVenda = retornoPossivel;
			_this.valorRestante = retornoPossivel;
			$('#valorProdutos').html('&nbsp;' + Formatter.moeda(retornoPossivel, 2,',','.'));
			$('#valorRestantePagamento').html('&nbsp;' + Formatter.moeda(_this.valorRestante, 2,',','.'));
			$('#valorPagamento').val(Formatter.moeda(_this.valorRestante, 2,',','.'));

			this.calcularValorRestante();
			
		}

		this.finalizarVenda = function(){

			$('#btnPagamento').attr('disabled', 'disabled');
			$('#divFormaPagamento').show();
			$('#divAdicionarProduto').hide();
			
		}

		this.continuarVenda = function(){

			$('#btnPagamento').removeAttr('disabled');
			$('#divFormaPagamento').hide();
			$('#divAdicionarProduto').show();
			
		}

		this.adicionarFormaPagamento = function(){

			var _this = this;

			if(this.validarCampoObrigatorio('formPagamento')){

				var id = _this.codFormaPagamento;
				
				_this.formaPagamento[id] = {'tipo':$('#pagamento').val(), 'parcelas':$('#parcelas').val(), 'valor': $('#valorPagamento').maskMoney('unmasked')[0]};

				console.log(_this.formaPagamento);
				
				_this.atualizarQtdPagamento();
				_this.calcularValorRestante();

				$('#divFormasPagamento').append('<p id="formaPagamento_'+id+'">Tipo: ' + _this.formaPagamento[id].tipo + ' Parcelas: ' + _this.formaPagamento[id].parcelas + ' Valor:' + Formatter.moeda(_this.formaPagamento[id].valor, 2,',','.') + ' <a href="javascript:venda.excluirFormaPagamento('+id+')" >Excluir</a></p>');

				_this.codFormaPagamento++;
				
				$('#pagamento').val('-1');
				$('#parcelas').val('-1');
				
			}
			
		}

		this.excluirFormaPagamento = function(id){

			var _this = this;
			
			delete _this.formaPagamento[id];
			
			$('#formaPagamento_'+id).remove();

			_this.atualizarQtdPagamento();
			_this.calcularValorRestante();

		}

		this.atualizarQtdPagamento = function(){

			if(App.count(this.formaPagamento) == 1){
				$("#qtdFormaPagamento").html(App.count(this.formaPagamento) + ' forma de pagamento');
			}else{
				$("#qtdFormaPagamento").html(App.count(this.formaPagamento) + ' formas de pagamento');
			}
			
			
		}

		this.calcularValorRestante = function(){

			var _this = this;
			
			var valorRestante = _this.valorVenda;

			console.log(_this.formaPagamento);
			
			for(var pagamento in _this.formaPagamento){
				valorRestante = parseFloat(valorRestante) - _this.formaPagamento[pagamento].valor;
			}

			_this.valorRestante = valorRestante;
			$('#valorRestantePagamento').html('&nbsp;' + Formatter.moeda(_this.valorRestante, 2,',','.'));

			if(_this.valorRestante == 0){
				$('#btnFinalizarVenda').removeAttr('disabled');
			}else{
				$('#btnFinalizarVenda').attr('disabled', 'disabled');
			}

			$('#valorPagamento').val(Formatter.moeda(_this.valorRestante, 2,',','.'));
						
		}
		
		this.salvar = function(){

			var _this = this;

			var venda = {};
			var formaPagamento = {};

			for(var produto in this.produtos){
				venda[produto] = _this.produtos[produto];
			}

			for(var pagamento in this.formaPagamento){
				formaPagamento[pagamento] = this.formaPagamento[pagamento].tipo + ' / ' + this.formaPagamento[pagamento].parcelas + ' - ' + Formatter.moeda(this.formaPagamento[pagamento].valor, 2,',','.');
			}
			
			venda['id'] = _this.opcoes.id;
			venda['forma_pagamento'] = formaPagamento;
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
	config.hash							= '';
	config.idCliente				= '{/literal}{$idCliente}{literal}';
	config.urlNotaFiscal		= '{/literal}{$basePath}{literal}nota-fiscal';
	config.urlDadosVenda		= '{/literal}{$basePath}{literal}venda/dados-form';
	config.urlCliente				= '{/literal}{$basePath}{literal}cliente/dados-form';
	config.urlVenda 				= '{/literal}{$basePath}{literal}venda';
	config.urlCategoria			= '{/literal}{$basePath}{literal}categoria/dados-entidade';
	config.urlSubcategoria	= '{/literal}{$basePath}{literal}subcategoria/dados-entidade';
	config.urlNova					= '{/literal}{$basePath}{literal}venda/form';
	config.urlIniciar				= '{/literal}{$basePath}{literal}venda/iniciar';
	config.urlProduto				= '{/literal}{$basePath}{literal}venda/pesquisar-produto';
	config.urlProdutoVenda	= '{/literal}{$basePath}{literal}venda/pesquisar-produto-venda';
	config.urlSalvar				= '{/literal}{$basePath}{literal}venda/finalizar-venda';
	config.urlAprovar				= '{/literal}{$basePath}{literal}venda/aprovar-venda';
	config.urlExcluir				= '{/literal}{$basePath}{literal}venda/excluir-venda';

	$(document).ready(function(){

		venda = new Venda(config);
		venda.carregarVenda();
		venda.carregarCliente();
		venda.carregarCategoria();
		//venda.carregarProdutos();
		venda.carregarProdutosVenda();

		$('#valorProduto').maskMoney();
		$('#valorPagamento').maskMoney();
		
		$('#formPagamento').submit(function(e){
			e.preventDefault();
			venda.adicionarFormaPagamento();
		});

		$('#formAdicionarProduto').submit(function(e){
			e.preventDefault();
			venda.carregarProdutos();
		});
		
		$('#formPesquisarProduto').submit(function(e){
			e.preventDefault();
		});


		var doc = new jsPDF();
		var specialElementHandlers = {
		    '#editor': function (element, renderer) {
		        return true;
		    }
		};

		$('#btnPDF').click(function () {  

			var HTML = '<html><body>';

			HTML += '<p><strong>OR&Ccedil;AMENTO:</strong></p>';

			HTML += '<p>PRISMA AUDIO CENTER EIRELI - ME</p>';
			HTML += '<p>28.801.726/0001-42</p>';
			HTML += '<p>53530-480</p>';
			HTML += '<p>Rua Cento e Noventa e Dois, 16</p>';
			HTML += '<p>Caet&eacute;s I - Abreu e Lima | PE</p>';
			HTML += '<p>&nbsp;</p>';
			HTML += '<p><strong>PRODUTOS</strong></p>';

			var data = venda;

			for(var chave in data.produtos){

				HTML += '<p>1 ' + data.produtos[chave].nome + ' - ' + Formatter.moeda(data.produtos[chave].preco_venda, 2,',','.')+'</p>'; 
				
			}

			HTML += '<p>&nbsp;</p>';
			HTML += '<p><strong>FORMA DE PAGAMENTO</strong></p>';

			for(var chave in data.formaPagamento){

				var tipo = formaPagamento[chave].split(' / ');
				var parcelas = tipo[1].split(' - ');
				var valor = parcelas[1];
						
				HTML += '<p>Tipo: ' + tipo[0] + ' Parcelas: ' + parcelas[0] + ' Valor:' + valor + '</p>';

			}

			HTML += '<p>&nbsp;</p>';
			HTML += '<p><strong>VALOR TOTAL</strong></p>';

			console.log(data.retornoPossivel);
			
			HTML += '<p>'+Formatter.moeda(data.valorVenda, 2,',','.')+'</p>';
			
			HTML += '</body></html>';

			console.log(HTML);
			
	    doc.fromHTML(HTML, 15, 15, {
	        'width': 170,
	            'elementHandlers': specialElementHandlers
	    });
	    doc.save('sample-file.pdf');
		});
		
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
							        <label class="control-label" id="tipo"></label>
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
							      <button type="button" style="width: 120px" class="btn btn-success" disabled="disabled" onclick="javascript:venda.finalizarVenda()" id="btnPagamento">Pagamento</button>
							      <button type="button" style="width: 120px; display: none" class="btn btn-success" onclick="javascript:venda.aprovarVenda()" id="btnAprovar">Aprovar Venda</button>
							      <button type="button" style="width: 120px; display: none" class="btn btn-success" onclick="javascript:venda.transmitirVenda()" id="btnTransmitir">Emitir NFE</button>
							      <button type="button" style="width: 120px" class="btn btn-primary" disabled="disabled"  onclick="javascript:venda.salvar()" id="btnFinalizarVenda">Finalizar Venda</button>
							      <button type="button" style="width: 120px; display: none" class="btn btn-danger" id="btnExcluir" onclick="javascript:venda.excluirVenda()">Excluir Venda</button>
							      <button type="button" style="width: 120px" class="btn btn-warning" onclick="venda.nova()" >Nova Venda</button>
							    </div>
							  </div>					
							
							</form>
						
							<h3 style="#margin-top: 0px"><span id="qtdProdutos">0 itens</span> / Total R$ <span id="valorProdutos">0,00</span></h3>
							<hr>
						
							<form action="#" method="post" id="formAdicionarProduto" name="formAdicionarProduto">
								<!-- ADICIONAR PRODUTO -->
								<div id="divAdicionarProduto">
									<div class="row">
										<div class="form-group col-md-2">
											<label>Categoria</label>
											<select class="form-control" id="id_categoria" name="id_categoria" onchange="javascript:venda.carregarSubcategoria()">
											</select>
										</div>
										<div class="form-group col-md-2" style="padding-left: 5px">
											<label>Sub-Categoria</label>
											<select class="form-control" id="id_subcategoria" name="id_subcategoria">
												<option>Categoria n&atilde;o informado(a)</option>
											</select>
										</div>
										<div class="form-group col-md-3" style="padding-left: 5px">
											<label>Produto</label>
											<input type="text" class="form-control" id="produto" name="produto" />
										</div>
										<div class="form-group col-md-2" style="padding-left: 5px">
											<label>&nbsp;</label>
											<br>
											<button type="button" class="btn btn-primary" onclick="venda.carregarProdutos()">Pesquisar</button>
										</div>
									</div>
								</div>
							</form>
							
							<form id="formPagamento" action="#">
								<!-- FORMA DE PAGAMENTO  -->
								<div id="divFormaPagamento" style="display: none">
									<div class="row">
									
										<div class="form-group col-md-2" style="">
											<label>Forma de Pagamento*</label>
											<select class="form-control" id="pagamento" name="pagamento" obrigatorio="obrigatorio">
												<option value="-1">Selecione</option>
												<option value="boleto">Boleto</option>
												<option value="cheque">Cheque</option>
												<option value="credito">Cr&eacute;dito</option>
												<option value="debito">D&eacute;bito</option>
												<option value="dinheiro">Dinheiro</option>
											</select>
										</div>
										<div class="form-group col-md-1" style="padding-left: 5px">
											<label>Parcelas*</label>
											<select class="form-control" id="parcelas" name="parcelas" obrigatorio="obrigatorio">
												<option value="-1">Selecione</option>
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
										<div class="form-group col-md-2" style="padding-left: 5px">
											<label>Valor</label>
											<input type="text" class="form-control" id="valorPagamento" name="valorPagamento" data-thousands="." data-decimal="," obrigatorio="obrigatorio" style="text-align: right" />
										</div>
										<div class="form-group col-md-1" style="padding-left: 5px">
											<label>&nbsp;</label>
											<br>
											<button type="button" class="btn btn-success" onclick="venda.adicionarFormaPagamento()" style="">
												&nbsp;
												<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
												&nbsp;	
											</button>
										</div>
										<div class="form-group col-md-1" style="undefined">
											<label>&nbsp;</label>
											<br>
											<button type="button" class="btn btn-default" onclick="venda.continuarVenda()" style="width: 150px">
												<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Continuar venda
											</button>
										</div>

									</div>
								</div>
							</form>

							<hr>
							<h3 style="#margin-top: 0px"><span id="qtdFormaPagamento">0 formas de pagamento</span> / Valor Restante R$ <span id="valorRestantePagamento">0,00</span></h3>
						
								<div id="divFormasPagamento">
								
								</div>
						
								<br>
								<br>
						
								<div class="box-body table-responsive no-padding">
						
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

								</div>
						
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
						<table id="tabelaPesquisarProdutos" class="table table-condensed table-striped">
						
							<thead>
								<tr>
									<th style="text-align: center"></th>
									<th style="text-align: center">Produto</th>
									<th style="text-align: center">Qtd</th>
									<th style="text-align: center">Val unit</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						
						</table>
		      </div>
		      <div class="modal-footer">
		      	<form id="formPesquisarProduto" action="#" class="form-horizontal col-sm-8" style="padding-left: 0px">
							<div class="form-group">
						    <label for="inputEmail3" class="col-sm-2 control-label">Qtd*</label>
						    <div class="col-sm-2" style="padding-left: 5px; padding-right: 5px">
									<input class="form-control" type="text" id="qtdProduto" name="qtdProduto" obrigatorio="obrigatorio" onkeyup="javascript:venda.calcularValorProduto()" disabled="disabled" />
						    </div>
						    <div class="col-sm-4" style="padding-left: 0px; padding-right: 10px">
									<input class="form-control" type="text" id="valorProduto" name="valorProduto" data-thousands="." data-decimal="," obrigatorio="obrigatorio" disabled="disabled" style="text-align: right" />
						    </div>
						    <div class="col-sm-2 checkbox" style="padding-left: 0px; display: none">
							    <label>
							      <input id="permitirDesconto" name="permitirDesconto"  type="checkbox" onclick="javascript:venda.aplicarDesconto()"> desconto
							    </label>
							  </div>
						  </div>
		      	</form>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        <button type="button" class="btn btn-primary" onclick="javascript:venda.adicionarProduto()">Adicionar</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		<div class="modal fade" tabindex="-1" role="dialog" id="modalTransmitir">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Transmitir Venda</h4>
		      </div>
		      <div class="modal-body" style="text-align: center">
		      	<p id="processando">Processando os dados. aguarde...</p>
		      	<br>
		      	<img src="{$basePath}img/loading.gif" id="loading" />
		      	<img src="{$basePath}img/alerta.png" width="150px" style="display: none" id="alerta" />
		      	<br>
		      	<br>
		      	<p id="erroAlerta"></p>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
{include file="../../templates/base.tpl"}