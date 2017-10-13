<?php /* Smarty version 3.1.27, created on 2017-10-12 21:44:21
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/sisnf/templates/topo.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2263172459e00c65b328f1_76554912%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a5e2819c855b65e13c4797acd02cf380dd9efc21' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/sisnf/templates/topo.tpl',
      1 => 1507855459,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2263172459e00c65b328f1_76554912',
  'variables' => 
  array (
    'basePath' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_59e00c65b8c693_00654856',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59e00c65b8c693_00654856')) {
function content_59e00c65b8c693_00654856 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2263172459e00c65b328f1_76554912';
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
    <!-- <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
js/Formatter.js"><?php echo '</script'; ?>
> -->
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