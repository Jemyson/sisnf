<?php /* Smarty version 3.1.27, created on 2017-10-16 18:32:15
         compiled from "C:\xampp\htdocs\sisnf\app\views\vendaGrid.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:87304563059e4df0f02fe09_84882292%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c098923a598d99d8a680d955f51df20b0d210c7f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\sisnf\\app\\views\\vendaGrid.tpl',
      1 => 1508160652,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '87304563059e4df0f02fe09_84882292',
  'variables' => 
  array (
    'basePath' => 0,
    'dadosCliente' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_59e4df0f08fcb2_72985910',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59e4df0f08fcb2_72985910')) {
function content_59e4df0f08fcb2_72985910 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '87304563059e4df0f02fe09_84882292';
echo $_smarty_tpl->getSubTemplate ("../../templates/topo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




	<?php echo '<script'; ?>
 type="text/javascript" language="javascript">

		var config = {};

		config.basePath = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
';
		
		config.pk     = 'id';
		config.modelo = 'venda';
		
		config.url    	= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/dados';
		config.form   	= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/form';
		config.excluir  = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/excluir';
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
		config.colunas.push({'nome':'id_cliente',		'titulo':'CLIENTE',	'cssbody':'text-align:left', 		'formatterDados':'<?php echo $_smarty_tpl->tpl_vars['dadosCliente']->value;?>
'});
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
			
	<?php echo '</script'; ?>
>

	
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
							<a class="pull-right btn btn-primary btn-xs" href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/form">
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