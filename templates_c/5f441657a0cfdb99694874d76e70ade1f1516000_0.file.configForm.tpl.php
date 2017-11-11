<?php /* Smarty version 3.1.27, created on 2017-11-11 16:33:14
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/configForm.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:6491388475a07507a584d70_22008679%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5f441657a0cfdb99694874d76e70ade1f1516000' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/configForm.tpl',
      1 => 1510428791,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6491388475a07507a584d70_22008679',
  'variables' => 
  array (
    'basePath' => 0,
    'id' => 0,
    'visualizar' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a07507a5d7be4_85094899',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a07507a5d7be4_85094899')) {
function content_5a07507a5d7be4_85094899 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '6491388475a07507a584d70_22008679';
echo $_smarty_tpl->getSubTemplate ("../../templates/topo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




	<?php echo '<script'; ?>
 type="text/javascript" language="javascript">

		var config = {};
	
		config.basePath = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
';
		
		config.pk     = 'id';
		config.modelo = 'configForm';
	
		config.url    = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
config/dados-form<?php if (isset($_smarty_tpl->tpl_vars['id']->value)) {?>?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;
}?>';
		config.form   = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
config/form';
		config.salvar = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
config/salvar';
		config.voltar = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
index';
	
		

		<?php if (isset($_smarty_tpl->tpl_vars['visualizar']->value) && $_smarty_tpl->tpl_vars['visualizar']->value == '1') {?>

		config.visualizar = '1';
		
		<?php }?>
			
		
				
		config.botoes = ['b','s'];

		config.colunas = [];
		config.colunas.push({'nome':'nome',	'titulo':'Raz&atilde;o Social',		'tipo':'text',			'span':'5',	'classe':'input-xlarge',	'obrigatorio':'1', 'disabled':'readonly'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'cnpj','titulo':'CNPJ',		'tipo':'text',			'span':'3',	'classe':'input-xlarge',	'obrigatorio':'0', 'disabled':'readonly'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'inscricaoEstadual','titulo':'INSCRI&Ccedil;&Atilde;O ESTADUAL',		'tipo':'text',			'span':'3',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'cep','titulo':'CEP',		'tipo':'text',			'span':'2',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'rua','titulo':'Endere&ccedil;o',		'tipo':'text',			'span':'4',	'classe':'input-xlarge',	'obrigatorio':'0'});
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
		
		var form = new Form('configForm', config);

		form.salvar = function(){

			var _this = this;
			
			_this.reset();
			
			$('.salvar').hide();
			$('.disabled').show();
			
			if(this.validarCampoObrigatorio()){
				
				jQuery.ajax({
					type:'POST',
					global:true,
					url:_this.opcoes.salvar,
					dataType:'json',
					data:$('#form_'+_this.modelo).serialize(),
					success: function(data){
						
						_this.reset();
						
						$('.btn-primary').show();
						$('.disabled').hide();
						
						if(data.error == '1'){
							$('#divError').show();
							$('#divError').html(data.msg);
						}else{
							$('#divSuccess').show();
							$('#divSuccess').html(data.msg);
						}
						
					},
					failure: function(){
					}
				});
				
			}else{

				alert("Os Campos em vermelho sao obrigatorios.");
				$('.salvar').show();
				$('.disabled').hide();
				
			}
			
		
		}
		
		$(document).ready(function(){
	
			form.criarFormulario();
			form.carregarCamposEntidade();
			form.load();

			$('#cep').mask('00000-000');

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
	
							$('#rua').val(data.logradouro);
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
config">Config</a> / Cadastro</h1>
				</div>
			</div>	

			<div class="row">

				<div class="col-lg-12">
				
					<div class="panel panel-default">
					
						<div class="panel-heading">
							<a class="pull-right btn btn-primary btn-xs" href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
index">
								Voltar  <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
							</a>Registro de Configura&ccedil;&atilde;o
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