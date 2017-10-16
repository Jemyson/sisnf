<?php /* Smarty version 3.1.27, created on 2017-10-16 18:32:31
         compiled from "C:\xampp\htdocs\sisnf\app\views\vendaInicio.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:209450621659e4df1fc74dc9_88868025%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2292cb1deda25df23aa173d42cf3a182964dd397' => 
    array (
      0 => 'C:\\xampp\\htdocs\\sisnf\\app\\views\\vendaInicio.tpl',
      1 => 1508160652,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '209450621659e4df1fc74dc9_88868025',
  'variables' => 
  array (
    'basePath' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_59e4df1fccd595_45896469',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59e4df1fccd595_45896469')) {
function content_59e4df1fccd595_45896469 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '209450621659e4df1fc74dc9_88868025';
echo $_smarty_tpl->getSubTemplate ("../../templates/topo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




	<style>
	
		.form-group {
    	margin-bottom: 0px;
    	padding-right: 0px;
		}
		.control-label {
			padding-right: 0px;
		}
	
	</style>

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
						
							<h3 style="margin-top: 0px">Dados da Venda</h3>
							<hr>
						
							<form class="form-horizontal">
							
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Tipo</label>
									<div class="col-sm-10">
							        <label class="control-label">Or&ccedil;amento</label>
							    </div>							  
							  </div>							
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Cliente</label>
									<div class="col-sm-10">
							        <label class="control-label">Jemyson Vagner Rosa da Silva</label>
							    </div>							  
						    </div>		
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Endere&ccedil;o</label>
									<div class="col-sm-10">
							        <label class="control-label" style="font-weight: normal">Rua Maria Augusta de Fran&ccedil;a Ferreira</label>
							        <label class="control-label">Bairro</label>
							        <label class="control-label" style="font-weight: normal">Ouro Preto</label>
							        <label class="control-label">Cidade</label>
							        <label class="control-label" style="font-weight: normal">Olinda</label>
							    </div>							  
						    </div>		
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">CPF</label>
									<div class="col-sm-10">
							        <label class="control-label" style="font-weight: normal">097.328.164-22</label>
							        <label class="control-label">Fone</label>
							        <label class="control-label" style="font-weight: normal">(81) 99800-6555</label>
							        <label class="control-label">E-mail</label>
							        <label class="control-label" style="font-weight: normal">jemyson.vagner@gmail.com</label>
							    </div>							  
						    </div>		
							  <div class="form-group" style="margin-top: 15px">
							    <div class="col-sm-offset-2 col-sm-10">
							      <button type="submit" disabled="disabled" class="btn btn-primary">Iniciar Venda</button>
							      <button type="submit" class="btn btn-danger">Finalizar Venda</button>
							      <button type="submit" class="btn btn-warning">Nova Venda</button>
							    </div>
							  </div>					
							
							</form>
						
							<h3 style="#margin-top: 0px">3 itens / Total R$ 19.748,00</h3>
							<hr>
						
							<form>
							
								<div class="row">
									<div class="form-group col-md-2" style="undefined">
										<label>Categoria*</label>
										<select class="form-control">
											<option>Selecione</option>
											<option>Audio</option>
											<option>Mixer</option>
											<option>Caixas</option>
										</select>
									</div>
									<div class="form-group col-md-3" style="undefined">
										<label>Produto*</label>
										<select class="form-control">
											<option>Selecione</option>
											<option>Placa M-audio</option>
											<option>Controlador Behringer UMX610</option>
											<option>Mesa Behringer X32</option>
										</select>
									</div>
									<div class="form-group col-md-1" style="undefined">
										<label>Qtd*</label>
										<input class="form-control" type="text" />
									</div>
									<div class="form-group col-md-2" style="undefined">
										<label>Total*</label>
										<input class="form-control" type="text" />
									</div>
									<div class="form-group col-md-2" style="undefined">
										<label>&nbsp;</label>
										<br>
										<button type="submit" class="btn btn-primary">Adicionar</button>
									</div>
								</div>
						
								<br>
								<br>
						
								<table class="table table-condensed table-striped">
								
									<thead>
										<tr>
											<th style="text-align: center"></th>
											<th style="text-align: center">Produto</th>
											<th style="text-align: center">Qtd</th>
											<th style="text-align: center">Val unit</th>
											<th style="text-align: center">Total</th>
											<th style="text-align: center">Tributo</th>
											<th style="text-align: center">A&ccedil;&otilde;es</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td style="text-align: center;"><a href="#"><i class="glyphicon glyphicon-trash"></i></a></td>
											<td>Mesa Behringer X32</td>
											<td style="text-align: right;">1</td>
											<td style="text-align: right;">15.500,00</td>
											<td style="text-align: right;">15.500,00</td>
											<td style="text-align: center;">n/d</td>
											<td style="text-align: center;"><a href="#"><i class="glyphicon glyphicon-usd" style="color: green"></i></a></td>
										</tr>
										<tr>
											<td style="text-align: center;"><a href="#"><i class="glyphicon glyphicon-trash"></i></a></td>
											<td>Controlador Behringer UMX610</td>
											<td style="text-align: right;">2</td>
											<td style="text-align: right;">999,00</td>
											<td style="text-align: right;">1.998,00</td>
											<td style="text-align: center;"><a href="#"><i class="glyphicon glyphicon-file" style="color: pink"></i></td>
											<td style="text-align: center;"><a href="#"><i class="glyphicon glyphicon-remove-sign" style="color: brown"></i></a></td>
										</tr>
										<tr>
											<td style="text-align: center;"><a href="#"><i class="glyphicon glyphicon-trash"></i></a></td>
											<td>Placa M-audio</td>
											<td style="text-align: right;">5</td>
											<td style="text-align: right;">450,00</td>
											<td style="text-align: right;">2.250,00</td>
											<td style="text-align: center;">n/d</td>
											<td style="text-align: center;"><a href="#"><i class="glyphicon glyphicon-usd" style="color: green"></i></a></td>
										</tr>
									</tbody>
								
								</table>

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