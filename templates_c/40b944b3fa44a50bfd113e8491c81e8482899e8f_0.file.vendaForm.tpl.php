<?php /* Smarty version 3.1.27, created on 2017-11-10 22:40:26
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/vendaForm.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1979014385a06550ae68ef0_00685742%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '40b944b3fa44a50bfd113e8491c81e8482899e8f' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/vendaForm.tpl',
      1 => 1508469757,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1979014385a06550ae68ef0_00685742',
  'variables' => 
  array (
    'id' => 0,
    'basePath' => 0,
    'hash' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a06550aeae428_83712079',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a06550aeae428_83712079')) {
function content_5a06550aeae428_83712079 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1979014385a06550ae68ef0_00685742';
echo $_smarty_tpl->getSubTemplate ("../../templates/topo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




	<?php echo '<script'; ?>
 type="text/javascript" language="javascript">

	Venda = function(opcoes){

		this.opcoes = opcoes;
		
		this.validarCampoObrigatorio = function(){
			var erro = 0;
			
			$('input[obrigatorio=obrigatorio]').each(function(){
				
				if(!App.isset($(this).val()) || $(this).val() == ''){
					erro = 1;
					$(this).parent().addClass( "control-group error" );
					$(this).parent().css("color", "#b94a48");
				}else{
					$(this).parent().removeClass( "control-group error" );
					$(this).parent().css("color", "");
				}
				
			});
			
			$('select[obrigatorio=obrigatorio]').each(function(){
				
				if(!App.isset($(this).val()) || $(this).val() == '-1' || ($(this).val() == '0' && App.isset($(this).attr('entidade')) )){
					erro = 1;
					$(this).parent().parent().addClass( "has-error" );
				}else{
					$(this).parent().parent().removeClass( "has-error" );
				}
				
			});
			
			if(erro != 0){
				return false;
			}else{
				return true;
			}
			
		}

		this.pesquisarCliente = function(){

			var _this = this;

			$.ajax({
				type:'POST',
				global:true,
				url:_this.opcoes.urlCliente,
				dataType:'json',
				data:'',
				success: function(data){

					var select = '<option value="0">Selecione</option>';
					for(var chave in data){

						select += '<option value="'+chave+'">'+data[chave]+'</option>';
						
					}						

					$('#id_cliente').html(select);
					
				},
				error: function(){
				}
			});
		
		}
		
		this.iniciar = function(){

			var _this = this;

			if(this.validarCampoObrigatorio()){

				$.ajax({
					type:'POST',
					global:true,
					url:_this.opcoes.urlSalvar,
					dataType:'json',
					data:$('#form').serialize(),
					success: function(data){

						if(data.error == 0){
							window.location = _this.opcoes.urlIniciar + '?id=' + _this.opcoes.id;
						}else{
							$('#divError').show();
							$('#divError').html(data.msg);
						}
						
					},
					error: function(){
					}
				});

			}else{

				alert("Os Campos em vermelho sao obrigatorios.");
				$('.btn-success').show();
				$('.disabled').hide();

			}
			
		}

	}

	var config = {};

	config.id						= '<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
';
	config.urlIniciar		= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/iniciar';
	config.urlCliente		= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
cliente/dados-entidade';
	config.urlSalvar		= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/salvar';

	$(document).ready(function(){

		venda = new Venda(config);
		venda.pesquisarCliente();

	});	
			
	<?php echo '</script'; ?>
>

	
		<div class="page-wrapper">
		
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"><a href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda">Vendas</a> / Cadastro</h1>
				</div>
			</div>	
		
			<div class="row">

				<div class="col-lg-12">
				
					<div class="panel panel-default">
					
						<div class="panel-heading">
							<a class="pull-right btn btn-primary btn-xs" href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda">
								Voltar  <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
							</a>Novo Registro: <?php echo $_smarty_tpl->tpl_vars['id']->value;?>

						</div>
					
						<div class="panel-body" id="divHTML">
						
							<form class="form-horizontal" method="post" id="form" name="form">
							
								<p id="divSuccess" class="bg-success" style="padding: 15px; display: none"></p>
								<p id="divError" class="bg-danger" style="padding: 15px; display: none"></p>
							
								<input type="hidden" id="id" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
								<input type="hidden" id="hash" name="hash" value="<?php echo $_smarty_tpl->tpl_vars['hash']->value;?>
">
							
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Tipo*</label>
							    <div class="col-sm-3">
							      <select class="form-control" id="tipo" name="tipo" obrigatorio="obrigatorio" entidade="entidade">
										  <option value="0">Selecione</option>
										  <option value="1">Or&ccedil;amento</option>
										  <option value="2">Venda</option>
										</select>
							    </div>
							  </div>							
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Cliente*</label>
							    <div class="col-sm-3">
							      <select class="form-control" id="id_cliente" name="id_cliente" obrigatorio="obrigatorio" entidade="entidade">
										</select>
							    </div>
							  </div>		
							  <div class="form-group">
							    <div class="col-sm-offset-2 col-sm-10">
							      <button type="button" onclick="venda.iniciar()" class="btn btn-primary">Iniciar Venda</button>
							    </div>
							  </div>					
							
							</form>
						
						</div>
						
					</div>
				
				</div>

			</div>		
		
		</div>






<?php echo $_smarty_tpl->getSubTemplate ("../../templates/base.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>