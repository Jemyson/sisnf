<?php /* Smarty version 3.1.27, created on 2017-10-12 20:28:37
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/produtoGrid.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:140102953959dffaa5affd51_23092721%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c91db0196c2b57baa0cffb43a995ac114e5764c6' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/produtoGrid.tpl',
      1 => 1507850916,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '140102953959dffaa5affd51_23092721',
  'variables' => 
  array (
    'basePath' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_59dffaa5b3ddb4_61871652',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59dffaa5b3ddb4_61871652')) {
function content_59dffaa5b3ddb4_61871652 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '140102953959dffaa5affd51_23092721';
echo $_smarty_tpl->getSubTemplate ("../../templates/topo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




	<?php echo '<script'; ?>
 type="text/javascript" language="javascript">

		var config = {};

		config.basePath = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
';
		
		config.pk     = 'id';
		config.modelo = 'produto';
		
		config.url    	= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto/dados';
		config.form   	= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto/form';
		config.excluir  = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto/excluir';
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
		config.colunas.push({'nome':'nome',		'titulo':'NOME'	,								'cssbody':'text-align:left'});
		config.colunas.push({'nome':'preco_venda',	'titulo':'PRE&Ccedil;O'	, 'width':'20%', 								'cssbody':'text-align:right'});
	
		var grid = new Grid('produtoGrid', config);

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
					<h1 class="page-header">Produtos</h1>
				</div>
			</div>	
		
			<div class="row">

				<div class="col-lg-12">
				
					<div class="panel panel-default">
					
						<div class="panel-heading">
							<a class="pull-right btn btn-primary btn-xs" href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto/form">
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