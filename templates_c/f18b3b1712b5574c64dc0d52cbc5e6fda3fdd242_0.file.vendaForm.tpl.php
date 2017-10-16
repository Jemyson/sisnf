<?php /* Smarty version 3.1.27, created on 2017-10-16 18:32:16
         compiled from "C:\xampp\htdocs\sisnf\app\views\vendaForm.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:195251934959e4df10d714b2_73746236%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f18b3b1712b5574c64dc0d52cbc5e6fda3fdd242' => 
    array (
      0 => 'C:\\xampp\\htdocs\\sisnf\\app\\views\\vendaForm.tpl',
      1 => 1508160652,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '195251934959e4df10d714b2_73746236',
  'variables' => 
  array (
    'basePath' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_59e4df10dd4942_21190993',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59e4df10dd4942_21190993')) {
function content_59e4df10dd4942_21190993 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '195251934959e4df10d714b2_73746236';
echo $_smarty_tpl->getSubTemplate ("../../templates/topo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




	<?php echo '<script'; ?>
 type="text/javascript" language="javascript">

			
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
							</a>Novo Registro: 1462
						</div>
					
						<div class="panel-body" id="divHTML">
						
							<form class="form-horizontal">
							
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Tipo</label>
							    <div class="col-sm-3">
							      <select class="form-control">
										  <option value="0">Selecione</option>
										  <option value="1">Or&ccedil;amento</option>
										  <option value="2">Venda</option>
										</select>
							    </div>
							  </div>							
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Cliente</label>
							    <div class="col-sm-3">
							      <select class="form-control">
										  <option value="0">Selecione</option>
										  <option value="1">Jemyson Vagner Rosa da Silva</option>
										</select>
							    </div>
							  </div>		
							  <div class="form-group">
							    <div class="col-sm-offset-2 col-sm-10">
							      <button type="submit" class="btn btn-success">Iniciar Venda</button>
							      <button type="submit" disabled="disabled" class="btn btn-danger">Finalizar Venda</button>
							      <button type="submit" class="btn btn-warning">Nova Venda</button>
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