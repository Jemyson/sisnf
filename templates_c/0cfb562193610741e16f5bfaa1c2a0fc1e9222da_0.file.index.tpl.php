<?php /* Smarty version 3.1.27, created on 2017-11-16 18:05:37
         compiled from "C:\xampp\htdocs\sisnf\app\views\index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2540342115a0dc561e0e706_61514648%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0cfb562193610741e16f5bfaa1c2a0fc1e9222da' => 
    array (
      0 => 'C:\\xampp\\htdocs\\sisnf\\app\\views\\index.tpl',
      1 => 1508848984,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2540342115a0dc561e0e706_61514648',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a0dc561e889c4_52639908',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a0dc561e889c4_52639908')) {
function content_5a0dc561e889c4_52639908 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2540342115a0dc561e0e706_61514648';
echo $_smarty_tpl->getSubTemplate ("../../templates/topo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>



<style>

	
</style>


<br>
<br>
<br>
<br>
<br>

<div class="container-fluid2">
    <div class="row-fluid">
        <div class="centering text-center">

		      <h1>
		      	<strong>SIS</strong><span style="font-weight: normal;">NFs</span>
					</h1>
		      
		      <p>M&oacute;dulo de Administra&ccedil;&atilde;o</p>
		      <h3>Sistema em desenvolvimento v 1.0</h3>
		      
        </div>
    </div>
</div>



<?php echo $_smarty_tpl->getSubTemplate ("../../templates/base.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<?php }
}
?>