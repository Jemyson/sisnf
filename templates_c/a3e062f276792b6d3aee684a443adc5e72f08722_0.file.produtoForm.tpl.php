<?php /* Smarty version 3.1.27, created on 2017-10-17 21:50:31
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/produtoForm.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:25214062159e6a557288d73_87790564%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a3e062f276792b6d3aee684a443adc5e72f08722' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/produtoForm.tpl',
      1 => 1508283150,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25214062159e6a557288d73_87790564',
  'variables' => 
  array (
    'basePath' => 0,
    'id' => 0,
    'visualizar' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_59e6a5572e12e4_92141240',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59e6a5572e12e4_92141240')) {
function content_59e6a5572e12e4_92141240 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '25214062159e6a557288d73_87790564';
echo $_smarty_tpl->getSubTemplate ("../../templates/topo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




	<?php echo '<script'; ?>
 type="text/javascript" language="javascript">

		var config = {};
	
		config.basePath = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
';
		
		config.pk     = 'id';
		config.modelo = 'produtoForm';
	
		config.url    = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto/dados-form<?php if (isset($_smarty_tpl->tpl_vars['id']->value)) {?>?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;
}?>';
		config.form   = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto/form';
		config.salvar = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto/salvar';
		config.voltar = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto';
	
		

		<?php if (isset($_smarty_tpl->tpl_vars['visualizar']->value) && $_smarty_tpl->tpl_vars['visualizar']->value == '1') {?>

		config.visualizar = '1';
		
		<?php }?>
			
		
				
		config.botoes = ['b','s'];

		config.colunas = [];
		config.colunas.push({'nome':'id',	'titulo':'C&oacute;digo',	'tipo':'text',			'span':'6',	'classe':'input-mini',		'obrigatorio':'1', 'disabled':'readonly'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'id_categoria',	'titulo':'Categoria',		'tipo':'entidade',	'carregaDadosEntidade':'<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
categoria',	'filho':'id_subcategoria',	'span':'6',	'classe':'input-xlarge',	'obrigatorio':'1'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'id_subcategoria',	'titulo':'Sub-Categoria',		'tipo':'entidade',	'carregaDadosEntidade':'<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
subcategoria', 'dependencia':'id_categoria', 'tituloDependencia':'Categoria',				'span':'6',	'classe':'input-xlarge',	'obrigatorio':'1'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'nome',	'titulo':'Nome',		'tipo':'text',			'span':'6',	'classe':'input-xlarge',	'obrigatorio':'1'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'preco_custo','titulo':'Pre&ccedil;o Custo',		'tipo':'text',			'span':'6',	'classe':'input-xlarge',	'obrigatorio':'1'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'preco_venda','titulo':'Pre&ccedil;o Venda',		'tipo':'text',			'span':'6',	'classe':'input-xlarge',	'obrigatorio':'1'});
		
		var form = new Form('campeonatoForm', config);

		$(document).ready(function(){
	
			form.criarFormulario();
			form.carregarCamposEntidade();
			form.load();
	
		});

	<?php echo '</script'; ?>
>


		<div class="page-wrapper">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"><a href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto">Produtos</a> / Cadastro</h1>
				</div>
			</div>	

			<div class="row">

				<div class="col-lg-12">
				
					<div class="panel panel-default">
					
						<div class="panel-heading">
							<a class="pull-right btn btn-primary btn-xs" href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto">
								Voltar  <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
							</a>Novo Registro
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