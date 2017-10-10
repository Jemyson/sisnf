<?php /* Smarty version 3.1.27, created on 2017-10-09 21:17:52
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:129737081059dc11b0cf4c00_53612341%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8e6f1e6a3283273392a66eff8b00e34f3ed5908' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/sisnf/app/views/index.tpl',
      1 => 1507594669,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '129737081059dc11b0cf4c00_53612341',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_59dc11b0d2f111_33017644',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59dc11b0d2f111_33017644')) {
function content_59dc11b0d2f111_33017644 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '129737081059dc11b0cf4c00_53612341';
echo $_smarty_tpl->getSubTemplate ("../../templates/topo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>



<style>

	
</style>


<div class="container-fluid2">
    <div class="row-fluid">
        <div class="centering text-center">
		      <h1>
		      	<strong>GAME</strong><span style="font-weight: normal;">STATION</span>
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