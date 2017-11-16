<?php /* Smarty version 3.1.27, created on 2017-11-16 18:05:37
         compiled from "C:\xampp\htdocs\sisnf\templates\topo.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:115564885a0dc561ec3731_84496658%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f630a176b32a1eeb27a3755d1fbc949d70377570' => 
    array (
      0 => 'C:\\xampp\\htdocs\\sisnf\\templates\\topo.tpl',
      1 => 1510850280,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '115564885a0dc561ec3731_84496658',
  'variables' => 
  array (
    'basePath' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a0dc561ed2fb8_81747614',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a0dc561ed2fb8_81747614')) {
function content_5a0dc561ed2fb8_81747614 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '115564885a0dc561ec3731_84496658';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	
		<title>Invoice System</title>
		<link  href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
img/favicon.ico" rel="shortcut icon" type="image/x-icon"/>

		<!-- <link rel="stylesheet" href="public/css/style.css" /> -->
				
				
		<!-- 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		 -->

		<!-- Optional theme -->
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> -->

		<!-- 
		 -->
		<link href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
css/bootstrap.min.css" rel="styleSheet">



		<style>
		
		.corpo{ padding: 20px; padding-top: 70px;}
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
js/jquery.min.js" type="text/javascript"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
js/jquery.cookies.js" type="text/javascript"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
js/bootstrap.min.js" type="text/javascript"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
js/jquery.maskMoney.js" type="text/javascript"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
js/jquery.mask.js" type="text/javascript"><?php echo '</script'; ?>
>


    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
js/Grid.js" type="text/javascript"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
js/Form.js" type="text/javascript"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
js/Campos.js" type="text/javascript"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
js/Formatter.js" type="text/javascript"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
js/App.js" type="text/javascript"><?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/javascript">
		
			App = new App();
			Formatter = new Formatter();
		
		<?php echo '</script'; ?>
>

	</head>

	<body class="skin-blue layout-top-nav">
	
	<?php echo $_smarty_tpl->getSubTemplate ("menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

	
		<div class="corpo">
<?php }
}
?>