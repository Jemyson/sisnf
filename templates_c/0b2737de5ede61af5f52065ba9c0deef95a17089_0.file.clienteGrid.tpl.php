<?php /* Smarty version 3.1.27, created on 2017-11-11 16:07:40
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/clienteGrid.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:19508448935a074a7cf27ee0_72024429%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b2737de5ede61af5f52065ba9c0deef95a17089' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/clienteGrid.tpl',
      1 => 1508984592,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19508448935a074a7cf27ee0_72024429',
  'variables' => 
  array (
    'basePath' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a074a7d0285b8_50213951',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a074a7d0285b8_50213951')) {
function content_5a074a7d0285b8_50213951 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '19508448935a074a7cf27ee0_72024429';
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
		config.colunas.push({'nome':'telefone',	'titulo':'TELEFONE',								'cssbody':'text-align:center'});
		config.colunas.push({'nome':'celular',	'titulo':'CELULAR',								'cssbody':'text-align:center'});
	
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