<?php /* Smarty version 3.1.27, created on 2018-01-08 22:34:17
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/produtoEntradaGrid.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:3450561255a541c1933d825_42758539%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b3f3e9b4ab0eee13727a15e8236a8ffcbb27a24' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/produtoEntradaGrid.tpl',
      1 => 1515461656,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3450561255a541c1933d825_42758539',
  'variables' => 
  array (
    'basePath' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a541c1936dd92_81006105',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a541c1936dd92_81006105')) {
function content_5a541c1936dd92_81006105 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '3450561255a541c1933d825_42758539';
echo $_smarty_tpl->getSubTemplate ("../../templates/topo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




	<?php echo '<script'; ?>
 type="text/javascript" language="javascript">

		var config = {};

		config.basePath = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
';
		
		config.pk     = 'id';
		config.modelo = 'produtoEntrada';
		
		config.url    	= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto/dados-entrada';
		config.form   	= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto/form-entrada';
		config.excluir  = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto/excluir-entrada';
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
			
	<?php echo '</script'; ?>
>

	
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
							<a class="pull-right btn btn-primary btn-xs" href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto/form-entrada">
								<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Novo registro
							</a>Lista de Registros
						</div>
					
						<div class="panel-body" id="divHTML">
						</div>
						
					</div>
				
				</div>

			</div>		
		
		</div>






<?php echo $_smarty_tpl->getSubTemplate ("../../templates/base.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>