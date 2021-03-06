{include file="../../templates/topo.tpl"}

{literal}

	<script type="text/javascript" language="javascript">

	Entrada = function(opcoes){

		this.opcoes = opcoes;
		
		this.validarCampoObrigatorio = function(){
			var erro = 0;
			
			$('input[obrigatorio=obrigatorio]').each(function(){
				
				if(!App.isset($(this).val()) || $(this).val() == ''){
					erro = 1;
					$(this).parent().addClass( "control-group error" );
					$(this).parent().css("color", "#b94a48");
				}else{
					$(this).parent().removeClass( "control-group error" );
					$(this).parent().css("color", "");
				}
				
			});
			
			$('select[obrigatorio=obrigatorio]').each(function(){
				
				if(!App.isset($(this).val()) || $(this).val() == '-1' || ($(this).val() == '0' && App.isset($(this).attr('entidade')) )){
					erro = 1;
					$(this).parent().parent().addClass( "has-error" );
				}else{
					$(this).parent().parent().removeClass( "has-error" );
				}
				
			});
			
			if(erro != 0){
				return false;
			}else{
				return true;
			}
			
		}

		this.pesquisarFornecedor = function(){

			var _this = this;

			$.ajax({
				type:'POST',
				global:true,
				url:_this.opcoes.urlFornecedor,
				dataType:'json',
				data:'',
				success: function(data){

					var select = '<option value="0">Selecione</option>';
					for(var chave in data){

						select += '<option value="'+chave+'">'+data[chave]+'</option>';
						
					}						

					$('#id_fornecedor').html(select);
					
				},
				error: function(){
				}
			});
		
		}
		
		this.iniciar = function(){

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

	config.id						= '{/literal}{$id}{literal}';
	config.urlIniciar		= '{/literal}{$basePath}{literal}venda/iniciar';
	config.urlFornecedor		= '{/literal}{$basePath}{literal}fornecedor/dados-entidade';
	config.urlSalvar		= '{/literal}{$basePath}{literal}venda/salvar';

	$(document).ready(function(){

		entrada = new Entrada(config);
		entrada.pesquisarFornecedor();

	});	
			
	</script>
{/literal}
	
		<div class="page-wrapper">
		
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"><a href="{$basePath}produto/entrada">Entrada Produtos</a> / Cadastro</h1>
				</div>
			</div>	
		
			<div class="row">

				<div class="col-lg-12">
				
					<div class="panel panel-default">
					
						<div class="panel-heading">
							<a class="pull-right btn btn-primary btn-xs" href="{$basePath}produto/entrada">
								Voltar  <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
							</a>Novo Registro: {$id}
						</div>
					
						<div class="panel-body" id="divHTML">
						
							<form class="form-horizontal" method="post" id="form" name="form">
							
								<p id="divSuccess" class="bg-success" style="padding: 15px; display: none"></p>
								<p id="divError" class="bg-danger" style="padding: 15px; display: none"></p>
							
								<input type="hidden" id="id" name="id" value="{$id}">
								<input type="hidden" id="hash" name="hash" value="{$hash}">
							
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Nota Fiscal*</label>
							    <div class="col-sm-1">
											<input type="text" class="form-control" id="produto" name="produto" />
							    </div>
							  </div>							
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Data Nota Fiscal*</label>
							    <div class="col-sm-2">
											<input type="text" class="form-control" id="produto" name="produto" />
							    </div>
							  </div>							
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Fornecedor*</label>
							    <div class="col-sm-3">
							      <select class="form-control" id="id_fornecedor" name="id_fornecedor" obrigatorio="obrigatorio" entidade="entidade">
										</select>
							    </div>
							  </div>		
							  <div class="form-group">
							    <div class="col-sm-offset-2 col-sm-10">
							      <button type="button" onclick="entrada.iniciar()" class="btn btn-primary">Salvar Entrada</button>
							    </div>
							  </div>					
							
							</form>
						
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






{include file="../../templates/base.tpl"}