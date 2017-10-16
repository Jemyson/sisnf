<?php

session_start();

$_SESSION['usuario']['tipo_login'] = 'logado';
$_SESSION['usuario']['nome'] = 'Jemyson Vagner Rosa da Silva';
$_SESSION['servidor']['nome'] = 'Sistema de Nota Fistal';
$_SESSION['funcionalidades'] = array();
$_SESSION['chavesAcesso'] = array();

phpinfo();