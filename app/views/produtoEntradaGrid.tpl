{include file="../../templates/topo.tpl"}

{literal}

	<script type="text/javascript" language="javascript">

		var config = {};

		config.basePath = '{/literal}{$basePath}{literal}';
		
		config.pk     = 'id';
		config.modelo = 'produtoEntrada';
		
		config.url    	= '{/literal}{$basePath}{literal}produto/dados-entrada';
		config.form   	= '{/literal}{$basePath}{literal}produto/form-entrada';
		config.excluir  = '{/literal}{$basePath}{literal}produto/excluir-entrada';
		config.botoes 	= ['i','v','a','e'];
		
		config.filtros = {}
		config.filtrosDados = {}

		config.filtros.CD_ESPORTE  = {'titulo':'id','campo':'id' ,'tipo':'numero'};
		config.filtros.DS_ESPORTE  = {'titulo':'Nome','campo':'nome' ,'tipo':'texto'};
		
		config.filtrosDados.tipo = [];
		config.filtrosDados.tipo.push({"id":"1","value":"Visualizar"});
		config.filtrosDados.tipo.push({"id":"2","value":"Incluir"});
		config.filtrosDados.tipo.push({"id":"3","value":"Alterar"});
		config.filtrosDados.tipo.push({"id":"4","value":"Excluir"});
		
		config.colunas = [];
		config.colunas.push({'nome':'id',		'titulo':'#' 		,'width':'5%', 	'cssbody':'text-align:center'});
		config.colunas.push({'nome':'nota_fiscal',		'titulo':'NOTA'	,								'cssbody':'text-align:left'});
		config.colunas.push({'nome':'data_nota_fiscal',	'titulo':'DATA NOTA'	, 'width':'20%', 	'funcaoFormatter':'Formatter.formatMoedaReal', 								'cssbody':'text-align:right'});
		config.colunas.push({'nome':'id_fornecedor',	'titulo':'FORNECEDOR'	, 'width':'30%', 	'funcaoFormatter':'Formatter.formatMoedaReal', 								'cssbody':'text-align:right'});
		config.colunas.push({'nome':'data_entrada',	'titulo':'DATA ENTRADA'	, 'width':'20%', 	'funcaoFormatter':'Formatter.formatMoedaReal', 								'cssbody':'text-align:right'});
	
		var grid = new Grid('produtoEntradaGrid', config);

		$(document).ready(function(){

			grid.criarTabela();
			grid.createFilters();
			grid.load();

		});
			
	</script>
{/literal}
	
		<div class="page-wrapper">
		
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Entrada Produtos</h1>
				</div>
			</div>	
		
			<div class="row">

				<div class="col-lg-12">
				
					<div class="panel panel-default">
					
						<div class="panel-heading">
							<a class="pull-right btn btn-primary btn-xs" href="{$basePath}produto/form-entrada">
								<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Novo registro
							</a>Lista de Registros
						</div>
					
						<div class="panel-body" id="divHTML">
						</div>
						
					</div>
				
				</div>

			</div>		
		
		</div>






{include file="../../templates/base.tpl"}