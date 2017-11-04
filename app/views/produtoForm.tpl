{include file="../../templates/topo.tpl"}

{literal}

	<script type="text/javascript" language="javascript">

		var config = {};
	
		config.basePath = '{/literal}{$basePath}{literal}';
		
		config.pk     = 'id';
		config.modelo = 'produtoForm';
	
		config.url    = '{/literal}{$basePath}{literal}produto/dados-form{/literal}{if isset($id)}?id={$id}{/if}{literal}';
		config.form   = '{/literal}{$basePath}{literal}produto/form';
		config.salvar = '{/literal}{$basePath}{literal}produto/salvar';
		config.voltar = '{/literal}{$basePath}{literal}produto';
	
		{/literal}

		{if isset($visualizar) && $visualizar == '1'}

		config.visualizar = '1';
		
		{/if}
			
		{literal}
				
		config.botoes = ['b','s'];

		config.colunas = [];
		config.colunas.push({'nome':'id',	'titulo':'C&oacute;digo',	'tipo':'text',			'span':'6',	'classe':'input-mini',		'obrigatorio':'1', 'disabled':'readonly'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'id_categoria',	'titulo':'Categoria',		'tipo':'entidade',	'carregaDadosEntidade':'{/literal}{$basePath}{literal}categoria',	'filho':'id_subcategoria',	'span':'6',	'classe':'input-xlarge',	'obrigatorio':'1'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'id_subcategoria',	'titulo':'Sub-Categoria',		'tipo':'entidade',	'carregaDadosEntidade':'{/literal}{$basePath}{literal}subcategoria', 'dependencia':'id_categoria', 'tituloDependencia':'Categoria',				'span':'6',	'classe':'input-xlarge',	'obrigatorio':'1'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'nome',	'titulo':'Nome',		'tipo':'text',			'span':'6',	'classe':'input-xlarge',	'obrigatorio':'1'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'preco_custo','titulo':'Pre&ccedil;o Custo',		'tipo':'text',			'span':'6',	'classe':'input-xlarge',	'obrigatorio':'1'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'preco_venda','titulo':'Pre&ccedil;o Venda',		'tipo':'text',			'span':'6',	'classe':'input-xlarge',	'obrigatorio':'1'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'ncm','titulo':'NCM',		'tipo':'text',			'span':'6',	'classe':'input-xlarge',	'obrigatorio':'1'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'cfop','titulo':'CFOP',		'tipo':'text',			'span':'6',	'classe':'input-xlarge',	'obrigatorio':'1'});
		
		var form = new Form('produtoForm', config);

		form.salvar = function(){

			var _this = this;
			
			_this.reset();
			
			$('.salvar').hide();
			$('.disabled').show();
			
			if(this.validarCampoObrigatorio()){

				$('#preco_custo').val($('#preco_custo').maskMoney('unmasked')[0]);
				$('#preco_venda').val($('#preco_venda').maskMoney('unmasked')[0]);

				console.log($('#preco_custo').val());
				
				jQuery.ajax({
					type:'POST',
					global:true,
					url:_this.opcoes.salvar,
					dataType:'json',
					data:$('#form_'+_this.modelo).serialize(),
					success: function(data){

						$('#preco_custo').maskMoney('mask');
						$('#preco_venda').maskMoney('mask');
						
						_this.reset();
						
						$('.btn-primary').show();
						$('.disabled').hide();
						
						if(data.error == '1'){
							$('#divError').show();
							$('#divError').html(data.msg);
						}else{
							$('#divSuccess').show();
							$('#divSuccess').html(data.msg + ' <a style="cursor: pointer" onclick="javascript:form.novo()">clique aqui</a> para inserir um novo registro.</a>');
						}
						
					},
					failure: function(){
					}
				});
				
			}else{

				alert("Os Campos em vermelho sao obrigatorios.");
				$('.salvar').show();
				$('.disabled').hide();
				
			}
			
		
		}

		
		$(document).ready(function(){
	
			form.criarFormulario();
			form.carregarCamposEntidade();
			form.load();

			$('#preco_custo').attr('data-thousands', '.');
			$('#preco_custo').attr('data-decimal', ',');
			$('#preco_custo').maskMoney();
			$('#preco_custo').maskMoney('mask');
			
			$('#preco_venda').attr('data-thousands', '.');
			$('#preco_venda').attr('data-decimal', ',');
			$('#preco_venda').maskMoney();
			$('#preco_venda').maskMoney('mask');
			
		});

	</script>
{/literal}

		<div class="page-wrapper">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"><a href="{$basePath}produto">Produtos</a> / Cadastro</h1>
				</div>
			</div>	

			<div class="row">

				<div class="col-lg-12">
				
					<div class="panel panel-default">
					
						<div class="panel-heading">
							<a class="pull-right btn btn-primary btn-xs" href="{$basePath}produto">
								Voltar  <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
							</a>Novo Registro
						</div>
					
						<div class="panel-body" id="divHTML">
						</div>
						
					</div>
				
				</div>

			</div>		

		</div>
		
		
		
		
		

{include file="../../templates/base.tpl"}