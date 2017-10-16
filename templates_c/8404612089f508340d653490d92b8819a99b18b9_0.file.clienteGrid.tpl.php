<?php /* Smarty version 3.1.27, created on 2017-10-16 18:29:21
         compiled from "C:\xampp\htdocs\sisnf\app\views\clienteGrid.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:107379280159e4de617918c8_89473527%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8404612089f508340d653490d92b8819a99b18b9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\sisnf\\app\\views\\clienteGrid.tpl',
      1 => 1508160652,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '107379280159e4de617918c8_89473527',
  'variables' => 
  array (
    'basePath' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_59e4de618197f7_09306709',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59e4de618197f7_09306709')) {
function content_59e4de618197f7_09306709 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '107379280159e4de617918c8_89473527';
echo $_smarty_tpl->getSubTemplate ("../../templates/topo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




	<?php echo '<script'; ?>
 type="text/javascript" language="javascript">

		var config = {};

		config.basePath = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
';
		
		config.pk     = 'id';
		config.modelo = 'cliente';
		
		config.url    	= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
cliente/dados';
		config.form   	= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
cliente/form';
		config.excluir  = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
cliente/excluir';
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
		config.colunas.push({'nome':'id',		'titulo':'#',			'width':'5%', 'cssbody':'text-align:center'});
		config.colunas.push({'nome':'nome',	'titulo':'NOME',								'cssbody':'text-align:left'});
	
		var grid = new Grid('clienteGrid', config);

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
					<h1 class="page-header">Clientes</h1>
				</div>
			</div>	
		
			<div class="row">

				<div class="col-lg-12">
				
					<div class="panel panel-default">
					
						<div class="panel-heading">
							<a class="pull-right btn btn-primary btn-xs" href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
cliente/form">
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