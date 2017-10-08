<?php /* Smarty version 3.1.27, created on 2017-10-08 11:54:38
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/sisnf/templates/menu.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:151588507659da3c2eb69d88_84934050%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f7ab4b22b3765f67e0e24aa243ceca8b94e1e5d' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/sisnf/templates/menu.tpl',
      1 => 1503010810,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '151588507659da3c2eb69d88_84934050',
  'variables' => 
  array (
    'realTime' => 0,
    'nomeUsuario' => 0,
    'basePath' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_59da3c2eb9da47_07822424',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59da3c2eb9da47_07822424')) {
function content_59da3c2eb9da47_07822424 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '151588507659da3c2eb69d88_84934050';
?>

<style>

		.nav li{ border-left: 1px solid #ddd }
		.nav li a{ padding-left: 20px; padding-right: 20px}
		.nav li a i{ color: #262626}
		.nav li a span{ margin-right: 10px}

</style>

	
	<nav role="navigation" class="nav navbar-default navbar-fixed-top">

			<div class="container-fluid" style="font-size: 12px;padding-right: 5px; padding-left: 5px; background: #eee">
				<p class="navbar-text pull-left" style="#display:none; margin-top: 0px; margin-bottom: 0px; padding-top: 2px; padding-bottom:10px; height: 20px">
					<!-- <i class="icon-file" style="margin-top: -1px"></i>Vers&atilde;o:<b>1.0.0</b>
				|	--><i class="glyphicon glyphicon-time" style="margin-top: -1px"></i><span id="dataTempoReal"></span>
				</p>
					
	        <?php echo '<script'; ?>
 type="text/javascript">
	        _TIMESTAMP = <?php echo $_smarty_tpl->tpl_vars['realTime']->value;?>
;
	        _TIMESTAMP_DIFF = (new Date()).getTime()-<?php echo $_smarty_tpl->tpl_vars['realTime']->value;?>
;
	        window.setInterval(function (){document.getElementById("dataTempoReal").innerHTML = (new Date((new Date()).getTime()-_TIMESTAMP_DIFF)).toLocaleString('pt-BR');}, 1000);
	        document.getElementById("dataTempoReal").innerHTML = (new Date((new Date()).getTime()-_TIMESTAMP_DIFF)).toLocaleString('pt-BR');
	        <?php echo '</script'; ?>
>
	        
				<p class="navbar-text pull-right" style="margin-top: 0px; margin-bottom: 0px; padding-top: 2px; padding-bottom:0px; height: 20px">
					<i class="glyphicon glyphicon-user"></i> <?php echo $_smarty_tpl->tpl_vars['nomeUsuario']->value;?>
</b>
			<!--| <a href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
usuario/trocar-senha"><iclass="pencil icon red"></i>Trocar Senha</a> -->
				| <a href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
login/logout"><i class="glyphicon glyphicon-off" style="margin-top: -0.5px"></i> Sair</a>
				</p>
			</div>


		<div class="navbar-header">
		
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu" aria-expanded="false">
			
				<span class="sr-only">Menu Navega&ccedil;&atilde;o</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			
			</button>
		
			<button type="button" class="navbar-toggle" data-toggle="collapse" aria-expanded="false"
					style="height: 34px; padding-top: 6px; color: #fff; background-color: #337ab7; border-color: #2e6da4">
				<span class="glyphicon glyphicon-plus-sign"></span> Nova Venda
			</button>
		
			<a class="navbar-brand" href="#"><label>GAME</label> STATION</a>

		</div>
			
		<div class="collapse navbar-collapse" id="menu" style="padding-left: 14px">

			<ul class="nav navbar-nav">
				<li>
					<a href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Venda</a>
		  	</li>
				<li>
					<a href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
produto"><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span> Produtos</a>
		  	</li>
				<li>
					<a href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
kit"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> Kits</a>
		  	</li>
				<li>
					<a href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
cliente"><span class="glyphicon glyphicon-user"></span> Clientes</a>
		  	</li>
				<li>
					<a href="usuarios.php"><span class="glyphicon glyphicon-lock"></span> Usuarios</a>
		  	</li>
				<li>
					<a href="perfil.php"><span class="glyphicon glyphicon-cog"></span> Configura&ccedil;&atilde;o</a>
		  	</li>
			</ul>
		</div>	
		
	</nav>	
<?php }
}
?>