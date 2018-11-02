<?php
define ('BASEPATH', true);
    ini_set('display_errors', 'On');


    ini_set('error_reporting', E_ALL);
require_once '../app/config.php';
require_once '../app/core/helpers/CoreHelper.php';
require_once '../app/core/autolaod.php';
require_once '../app/core/helpers/FlashMessages.php';
//require_once '../app/core/Router.php';
//require_once '../app/core/BaseController.php';

$router = new  Router();



$controller = $router->getController();
$method = $router->getMethod();
$param = $router->getParam();
//echo $controller.'<br>';
//echo $method.'<br>';

if(!CoreHelper::validateController($controller))
    $controller = 'ErrorPageController';

require_once PATH_CONTROLLER. $controller.'.php';



if(!CoreHelper::validateMethodController($controller, $method))
    $method = 'index';


$controlador = new $controller();
$controlador->$method($param);


?>

