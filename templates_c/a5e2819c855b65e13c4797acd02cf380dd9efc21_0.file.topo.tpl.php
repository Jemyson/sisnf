<?php /* Smarty version 3.1.27, created on 2017-10-08 11:54:30
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/sisnf/templates/topo.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:67927193459da3c26696b67_44684044%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a5e2819c855b65e13c4797acd02cf380dd9efc21' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/sisnf/templates/topo.tpl',
      1 => 1503010810,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '67927193459da3c26696b67_44684044',
  'variables' => 
  array (
    'basePath' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_59da3c266d9b92_87433079',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59da3c266d9b92_87433079')) {
function content_59da3c266d9b92_87433079 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '67927193459da3c26696b67_44684044';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	
		<title>Franquia</title>

		<!-- <link rel="stylesheet" href="public/css/style.css" /> -->
				
		<link href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
css/bootstrap.css" rel="styleSheet">



		<style>
		
		.corpo{ padding: 20px; padding-top: 85px;}
		.page-wrapper h1{ margin-top: 0}
		
		div.dataTables_paginate ul.pagination {
		    margin: 2px 0;
		    white-space: nowrap;
		}
		
		div.dataTables_info {
		    padding-top: 8px;
		    color: #999;
		}
		
		</style>



		<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
js/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
js/jquery.cookies.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
js/bootstrap.min.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
js/Grid.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
js/Form.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
js/Campos.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
js/Formatter.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
js/App.js"><?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/javascript">
		
			App = new App();
		
		<?php echo '</script'; ?>
>

	</head>

	<body>
	
	<?php echo $_smarty_tpl->getSubTemplate ("menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

	
		<div class="corpo">
<?php }
}
?>