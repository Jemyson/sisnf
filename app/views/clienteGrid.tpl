{include file="../../templates/topo.tpl"}

{literal}

	<script type="text/javascript" language="javascript">

		var config = {};

		config.basePath = '{/literal}{$basePath}{literal}';
		
		config.pk     = 'id';
		config.modelo = 'cliente';
		
		config.url    	= '{/literal}{$basePath}{literal}cliente/dados';
		config.form   	= '{/literal}{$basePath}{literal}cliente/form';
		config.excluir  = '{/literal}{$basePath}{literal}cliente/excluir';
		config.botoes 	= ['i','v','a','e'];
		
		config.filtros = {}
		config.filtrosDados = {}

		config.filtros.id  		= {'titulo':'id','campo':'id' ,'tipo':'numero'};
		config.filtros.nome  	= {'titulo':'Nome','campo':'nome' ,'tipo':'texto'};
		
		config.filtrosDados.tipo = [];
		config.filtrosDados.tipo.push({"id":"1","value":"Visualizar"});
		config.filtrosDados.tipo.push({"id":"2","value":"Incluir"});
		config.filtrosDados.tipo.push({"id":"3","value":"Alterar"});
		config.filtrosDados.tipo.push({"id":"4","value":"Excluir"});
		
		config.colunas = [];
		config.colunas.push({'nome':'id',		'titulo':'#',			'width':'5%', 'cssbody':'text-align:center'});
		config.colunas.push({'nome':'nome',	'titulo':'NOME',								'cssbody':'text-align:left'});
		config.colunas.push({'nome':'telefone',	'titulo':'TELEFONE',								'cssbody':'text-align:center'});
		config.colunas.push({'nome':'celular',	'titulo':'CELULAR',								'cssbody':'text-align:center'});
	
		var grid = new Grid('clienteGrid', config);

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
					<h1 class="page-header">Clientes</h1>
				</div>
			</div>	
		
			<div class="row">

				<div class="col-lg-12">
				
					<div class="panel panel-default">
					
						<div class="panel-heading">
							<a class="pull-right btn btn-primary btn-xs" href="{$basePath}cliente/form">
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