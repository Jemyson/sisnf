{include file="../../templates/topo.tpl"}

{literal}

	<script type="text/javascript" language="javascript">

		var config = {};

		config.basePath = '{/literal}{$basePath}{literal}';
		
		config.pk     = 'id';
		config.modelo = 'venda';
		
		config.url    	= '{/literal}{$basePath}{literal}venda/dados';
		config.form   	= '{/literal}{$basePath}{literal}venda/iniciar';
		config.excluir  = '{/literal}{$basePath}{literal}venda/excluir';
		config.botoes 	= ['i','v','a','e'];
		
		config.filtros = {}
		config.filtrosDados = {}

		config.filtros.CD_ESPORTE  = {'titulo':'id','campo':'id' ,'tipo':'numero'};
		config.filtros.DS_ESPORTE  = {'titulo':'Valor','campo':'valor' ,'tipo':'texto'};
		
		config.filtrosDados.tipo = [];
		config.filtrosDados.tipo.push({"id":"1","value":"Visualizar"});
		config.filtrosDados.tipo.push({"id":"2","value":"Incluir"});
		config.filtrosDados.tipo.push({"id":"3","value":"Alterar"});
		config.filtrosDados.tipo.push({"id":"4","value":"Excluir"});
		
		config.colunas = [];
		config.colunas.push({'nome':'id',						'titulo':'#', 			'cssbody':'text-align:center', 	'width':'5%'});
		config.colunas.push({'nome':'id_cliente',		'titulo':'CLIENTE',	'cssbody':'text-align:left', 		'formatterDados':'{/literal}{$dadosCliente}{literal}'});
		config.colunas.push({'nome':'tipo',					'titulo':'TIPO',		'cssbody':'text-align:center', 	'formatterDados':'{"1":"Or&ccedil;amento", "2":"Venda"}'});
		config.colunas.push({'nome':'data_venda',		'titulo':'DATA',		'cssbody':'text-align:center',	'funcaoFormatter':'Formatter.data'});
		config.colunas.push({'nome':'valor',				'titulo':'VALOR',  	'cssbody':'text-align:right'});
		config.colunas.push({'nome':'status',				'titulo':'STATUS',  'cssbody':'text-align:center', 	'formatterDados':'{"0":"Aguardando", "1":"Pendente", "2":"Pago"}'});
	
		var grid = new Grid('vendaGrid', config);

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
					<h1 class="page-header">Vendas</h1>
				</div>
			</div>	
		
			<div class="row">

				<div class="col-lg-12">
				
					<div class="panel panel-default">
					
						<div class="panel-heading">
							<a class="pull-right btn btn-primary btn-xs" href="{$basePath}venda/form">
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