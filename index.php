<?php

define('CONTROLLERS', 'app/controllers/');
define('MODELS', 'app/models/');
define('VIEWS', 'app/views/');
define('CON_PATH', 'app/configs/');
	
define('PHPService', 'lib/PHPService/');

/* defini chaves de acesso */

require_once 'lib/Smarty/Smarty.class.php';
require_once 'lib/Bootstrap.php';
require_once 'lib/Controller.php';
require_once 'lib/Model.php';
require_once 'app/controllers/AppController.php';

session_start();

$systema = new Bootstrap();
$systema->run();
