<?php /* Smarty version 3.1.27, created on 2017-10-09 21:19:09
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/sisnf/templates/menu.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:159961399559dc11fd36e7b0_83631357%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f7ab4b22b3765f67e0e24aa243ceca8b94e1e5d' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/sisnf/templates/menu.tpl',
      1 => 1507594747,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '159961399559dc11fd36e7b0_83631357',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_59dc11fd39deb2_16363273',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59dc11fd39deb2_16363273')) {
function content_59dc11fd39deb2_16363273 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '159961399559dc11fd36e7b0_83631357';
?>

<style>

		.preview__header{font-size:12px;height:54px;background-color:#262626;z-index:100;line-height:54px;margin-bottom:1px}
		.preview__envato-logo{float:left;padding:0 20px}
		.preview__envato-logo a{display:inline-block;position:absolute;top:18px;text-indent:-9999px;height:18px;width:152px;#background:url(//public-assets.envato-static.com/assets/logos/envato_market-6eed4f715209e46c7454f26f3f25f7560d9d94713c11a5717436cd18642fb0a0.svg);background-size:152px 18px}
		@media (max-width: 568px){
			.preview__envato-logo{padding:0 10px}
			.preview__envato-logo a{position:absolute;top:20px;left:15px;height:14px;width:118px;background-size:118px 14px}
		}
		.preview__actions{float:right}
		.preview__action--buy,.preview__action--close{display:inline-block;padding:0 20px}
		@media (max-width: 568px){
			.preview__action--buy{padding:0 10px}
		}
		.preview__action--purchase-form{display:inline-block}
		.preview__action--item-details{display:inline-block}
		.preview__action--close{border-left:1px solid #333333}
		.preview__action--close a{color:#999999;text-decoration:none}
		.preview__action--close a:hover{color:white}
		.preview__action--close a i{color:white;font-size:10px;margin-right:10px}
		@media (max-width: 568px){
			.preview__action--close a i{margin-right:0}
		}
		@media (max-width: 568px){
			.preview__action--close a span{display:none}
		}

		.navbar-brand a {color: #fff; text-transform: uppercase; #font-weight: bold; text-decoration: none; font-weight: 500}
		.navbar-brand a:hover {text-decoration: none}
		
		.navbar-brand label {color: #6f9a37; font-weight: 500; cursor: pointer}
		
</style>

	
		<div class="preview__header navbar-fixed-top" data-view="ctaHeader">
		
			<div class="navbar-brand">
	    	<a href="#"><label>Invoice</label> System</a>
	  	</div>
 			
				<div class="preview__action--close">
					<a href="clientes"><i class="glyphicon glyphicon-user"></i> Clientes</a>
		  	</div>
				<div class="preview__action--close">
					<a href="facturas.php"><i class="glyphicon glyphicon-list-alt"></i> Faturas <span class="sr-only">(current)</span></a>
		  	</div>
				<div class="preview__action--close">
					<a href="productos.php"><i class="glyphicon glyphicon-barcode"></i> Produtos</a>
		  	</div>
				<div class="preview__action--close">
					<a href="usuarios.php"><i class="glyphicon glyphicon-lock"></i> Usuarios</a>
		  	</div>
				<div class="preview__action--close">
					<a href="perfil.php"><i class="glyphicon glyphicon-cog"></i> Configura&ccedil;&atilde;o</a>
		  	</div>
 			
   	<div class="preview__actions">
				<div class="preview__action--close" style="border-left: 0;">
					<a href="usuarios.php"><i class="glyphicon glyphicon-user"></i>Usuario: Jemyson Vagner Rosa da Silva</a>
		  	</div>
	
	  		<div class="preview__action--close">
	    		<a href="login.php?logout"><i class="glyphicon glyphicon-off"></i> Sair</a>  
	  		</div>
			</div>
		</div>		
	<?php }
}
?>