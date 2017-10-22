<?php /* Smarty version 3.1.27, created on 2017-10-21 23:08:31
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/clienteGrid.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:90499415059ebfd9fc3e0a3_98267270%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b2737de5ede61af5f52065ba9c0deef95a17089' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/clienteGrid.tpl',
      1 => 1508638109,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '90499415059ebfd9fc3e0a3_98267270',
  'variables' => 
  array (
    'basePath' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_59ebfd9fc872f6_22718291',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59ebfd9fc872f6_22718291')) {
function content_59ebfd9fc872f6_22718291 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '90499415059ebfd9fc3e0a3_98267270';
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