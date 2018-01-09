<?php /* Smarty version 3.1.27, created on 2018-01-08 22:24:31
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/fornecedorForm.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:6173845935a5419cf28d858_93792120%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8cc75a8aeb3c3f801653c2c063c533b3bd220ef8' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/fornecedorForm.tpl',
      1 => 1508984592,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6173845935a5419cf28d858_93792120',
  'variables' => 
  array (
    'basePath' => 0,
    'id' => 0,
    'visualizar' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a5419cf2e57d3_73561066',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a5419cf2e57d3_73561066')) {
function content_5a5419cf2e57d3_73561066 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '6173845935a5419cf28d858_93792120';
echo $_smarty_tpl->getSubTemplate ("../../templates/topo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




	<?php echo '<script'; ?>
 type="text/javascript" language="javascript">

		var config = {};
	
		config.basePath = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
';
		
		config.pk     = 'id';
		config.modelo = 'fornecedorForm';
	
		config.url    = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
fornecedor/dados-form<?php if (isset($_smarty_tpl->tpl_vars['id']->value)) {?>?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;
}?>';
		config.form   = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
fornecedor/form';
		config.salvar = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
fornecedor/salvar';
		config.voltar = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
fornecedor';
	
		

		<?php if (isset($_smarty_tpl->tpl_vars['visualizar']->value) && $_smarty_tpl->tpl_vars['visualizar']->value == '1') {?>

		config.visualizar = '1';
		
		<?php }?>
			
		
				
		config.botoes = ['b','s'];

		config.colunas = [];
		config.colunas.push({'nome':'id',	'titulo':'C&oacute;digo',	'tipo':'text',			'span':'1',	'classe':'input-mini',		'obrigatorio':'1', 'disabled':'readonly'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'nome',	'titulo':'Nome',		'tipo':'text',			'span':'5',	'classe':'input-xlarge',	'obrigatorio':'1'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'cpf','titulo':'CPF',		'tipo':'text',			'span':'3',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'cnpj','titulo':'CNPJ',		'tipo':'text',			'span':'3',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'cep','titulo':'CEP',		'tipo':'text',			'span':'2',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'endereco','titulo':'Endere&ccedil;o',		'tipo':'text',			'span':'4',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'numero','titulo':'N&uacute;mero',		'tipo':'text',			'span':'1',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'bairro','titulo':'Bairro',		'tipo':'text',			'span':'3',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'cidade','titulo':'Cidade',		'tipo':'text',			'span':'3',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'nome':'cod_cidade','titulo':'C&oacute;d. Cidade',		'tipo':'hide',			'span':'6',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'uf','titulo':'UF',		'tipo':'text',			'span':'1',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'telefone','titulo':'Telefone',		'tipo':'text',			'span':'2',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'celular','titulo':'Celular',		'tipo':'text',			'span':'2',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'email','titulo':'E-mail',		'tipo':'text',			'span':'5',	'classe':'input-xlarge',	'obrigatorio':'0'});
		
		var form = new Form('fornecedorForm', config);

		$(document).ready(function(){
	
			form.criarFormulario();
			form.carregarCamposEntidade();
			form.load();

			$('#cpf').mask('000.000.000-00');
			$('#cnpj').mask('00.000.000/0000-00');
			$('#cep').mask('00000-000');
			$('#telefone').mask('(00) 0000-0000');
			$('#celular').mask('(00) 00000-0000');

			$('#cep').blur(function(){

				var cep = $(this).val().replace(/\D/g, '');

				if (cep != "") {
					
					$.ajax({
						type:'POST',
						global:true,
						url:'//viacep.com.br/ws/'+ cep +'/json/?callback=?',
						dataType:'json',
						data:'',
						success: function(data){
	
							$('#endereco').val(data.logradouro);
							$('#bairro').val(data.bairro);
							$('#cidade').val(data.localidade);
							$('#cod_cidade').val(data.ibge);
							$('#uf').val(data.uf);
						
						},
						error: function(){
						}
					});

				}
				
			});
			
		});

	<?php echo '</script'; ?>
>


		<div class="page-wrapper">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"><a href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
fornecedor">Fornecedor</a> / Cadastro</h1>
				</div>
			</div>	

			<div class="row">

				<div class="col-lg-12">
				
					<div class="panel panel-default">
					
						<div class="panel-heading">
							<a class="pull-right btn btn-primary btn-xs" href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
fornecedor">
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