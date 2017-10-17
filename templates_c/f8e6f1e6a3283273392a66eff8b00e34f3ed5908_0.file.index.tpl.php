<?php /* Smarty version 3.1.27, created on 2017-10-16 20:56:12
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:52316582459e5471c5faf14_15456240%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8e6f1e6a3283273392a66eff8b00e34f3ed5908' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/index.tpl',
      1 => 1508198158,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '52316582459e5471c5faf14_15456240',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_59e5471c653996_05241297',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59e5471c653996_05241297')) {
function content_59e5471c653996_05241297 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '52316582459e5471c5faf14_15456240';
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