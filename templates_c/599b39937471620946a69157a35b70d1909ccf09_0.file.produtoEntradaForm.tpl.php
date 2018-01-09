<?php /* Smarty version 3.1.27, created on 2018-01-08 22:35:55
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/produtoEntradaForm.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:4371066425a541c7b5798f3_63681881%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '599b39937471620946a69157a35b70d1909ccf09' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/produtoEntradaForm.tpl',
      1 => 1515461754,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4371066425a541c7b5798f3_63681881',
  'variables' => 
  array (
    'basePath' => 0,
    'id' => 0,
    'visualizar' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a541c7b5bf014_19330491',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a541c7b5bf014_19330491')) {
function content_5a541c7b5bf014_19330491 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '4371066425a541c7b5798f3_63681881';
echo $_smarty_tpl->getSubTemplate ("../../templates/topo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




	<?php echo '<script'; ?>
 type="text/javascript" language="javascript">

		var config = {};
	
		config.basePath = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
';
		
		config.pk     = 'id';
		config.modelo = 'produtoEntradaForm';
	
		config.url    = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto/dados-entrada-form<?php if (isset($_smarty_tpl->tpl_vars['id']->value)) {?>?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;
}?>';
		config.form   = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto/form-entrada';
		config.salvar = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto/salvar-entrada';
		config.voltar = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto/entrada';
	
		

		<?php if (isset($_smarty_tpl->tpl_vars['visualizar']->value) && $_smarty_tpl->tpl_vars['visualizar']->value == '1') {?>

		config.visualizar = '1';
		
		<?php }?>
			
		
				
		config.botoes = ['b','s'];

		config.colunas = [];
		config.colunas.push({'nome':'id',	'titulo':'C&oacute;digo',	'tipo':'text',			'span':'6',	'classe':'input-mini',		'obrigatorio':'1', 'disabled':'readonly'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'id_fornecedor',	'titulo':'Fornecedor',		'tipo':'entidade',	'carregaDadosEntidade':'<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
fornecedor',	'span':'6',	'classe':'input-xlarge',	'obrigatorio':'1'});
		config.colunas.push({'tipo':'linha'});
		
		var form = new Form('produtoForm', config);

		form.salvar = function(){

			var _this = this;
			
			_this.reset();
			
			$('.salvar').hide();
			$('.disabled').show();
			
			if(this.validarCampoObrigatorio()){

				$('#preco_custo').val($('#preco_custo').maskMoney('unmasked')[0]);
				$('#preco_venda').val($('#preco_venda').maskMoney('unmasked')[0]);

				console.log($('#preco_custo').val());
				
				jQuery.ajax({
					type:'POST',
					global:true,
					url:_this.opcoes.salvar,
					dataType:'json',
					data:$('#form_'+_this.modelo).serialize(),
					success: function(data){

						$('#preco_custo').maskMoney('mask');
						$('#preco_venda').maskMoney('mask');
						
						_this.reset();
						
						$('.btn-primary').show();
						$('.disabled').hide();
						
						if(data.error == '1'){
							$('#divError').show();
							$('#divError').html(data.msg);
						}else{
							$('#divSuccess').show();
							$('#divSuccess').html(data.msg + ' <a style="cursor: pointer" onclick="javascript:form.novo()">clique aqui</a> para inserir um novo registro.</a>');
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

			$('#preco_custo').attr('data-thousands', '.');
			$('#preco_custo').attr('data-decimal', ',');
			$('#preco_custo').maskMoney();
			$('#preco_custo').maskMoney('mask');
			
			$('#preco_venda').attr('data-thousands', '.');
			$('#preco_venda').attr('data-decimal', ',');
			$('#preco_venda').maskMoney();
			$('#preco_venda').maskMoney('mask');
			
		});

	<?php echo '</script'; ?>
>


		<div class="page-wrapper">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"><a href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto/entrada">Entrada Produtos</a> / Cadastro</h1>
				</div>
			</div>	

			<div class="row">

				<div class="col-lg-12">
				
					<div class="panel panel-default">
					
						<div class="panel-heading">
							<a class="pull-right btn btn-primary btn-xs" href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto/entrada">
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