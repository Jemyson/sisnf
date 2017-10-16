<?php /* Smarty version 3.1.27, created on 2017-10-16 18:32:08
         compiled from "C:\xampp\htdocs\sisnf\app\views\index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:42704911359e4df08ea45a8_62822822%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0cfb562193610741e16f5bfaa1c2a0fc1e9222da' => 
    array (
      0 => 'C:\\xampp\\htdocs\\sisnf\\app\\views\\index.tpl',
      1 => 1508171527,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '42704911359e4df08ea45a8_62822822',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_59e4df08f027d1_02278571',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59e4df08f027d1_02278571')) {
function content_59e4df08f027d1_02278571 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '42704911359e4df08ea45a8_62822822';
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
		      	<strong>SIS</strong><span style="font-weight: normal;">NF</span>
					</h1>
		      
		      <p>M&oacute;dulo de Administra&ccedil;&atilde;o</p>
        </div>
    </div>
</div>



<?php echo $_smarty_tpl->getSubTemplate ("../../templates/base.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<?php }
}
?>