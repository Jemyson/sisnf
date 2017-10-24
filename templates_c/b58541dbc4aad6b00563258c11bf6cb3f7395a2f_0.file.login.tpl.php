<?php /* Smarty version 3.1.27, created on 2017-10-24 14:43:33
         compiled from "C:\xampp\htdocs\sisnf\app\views\login.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:166390222759ef35757e84e1_61918081%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b58541dbc4aad6b00563258c11bf6cb3f7395a2f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\sisnf\\app\\views\\login.tpl',
      1 => 1508848984,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '166390222759ef35757e84e1_61918081',
  'variables' => 
  array (
    'basePath' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_59ef357588e4d4_54791396',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59ef357588e4d4_54791396')) {
function content_59ef357588e4d4_54791396 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '166390222759ef35757e84e1_61918081';
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
css/bootstrap.min.css" rel="styleSheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
css/signin.css" rel="styleSheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"><?php echo '</script'; ?>
>
      <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
login/efetuar-login" method="post">
				<img alt="logo" src="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
img/logo.png" class="img-responsive" height="80%">
        <h2 class="form-signin-heading">Login</h2>
        <input type="text" id="login" name="login" class="form-control" placeholder="Usu&aacute;rio" required autofocus>
        <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Matenha-me conectado
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      </form>

    </div> <!-- /container -->


  </body>
</html>
<?php }
}
?>