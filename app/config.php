<?php

defined('BASEPATH') or exit ("NO SE PERMITE EL ACCESO");
/*
    valores url
 */

define ('URL', $_SERVER['REQUEST_URI']);

/*
    VALORES DE CORE
 */

define ('CORE', '../app/core/');
define ('REQUEST_METHOD', $_SERVER['REQUEST_METHOD']);

/*
 VALORES DE RUTAS

 */

define ('PATH_CONTROLLER', '../app/controllers/');
define ('PATH_VIEWS', '../views/');
define ('ROOT', $_SERVER['DOCUMENT_ROOT']);
/*
    database
 */
define ('DRIVER', 'mysql');
define ('HOST', 'localhost');
define ('USER','root');
define ('PASS', '');
define ('DB_NAME', 'tecno');
define ('CHARSET', 'UTF8');
define ('FOLDER', 'http://localhost/pg24');
define ('CSS', '/css');
define ('VIEWS', '../views');

/*
 errores
 */

define ('ERROR_REPORTING_LEVEL', 1);

/*
 empresa
 */
define ('MONEDA', 'BF');
include 'core/Conectar.php';
include 'core/EntidadBase.php';
include 'core/BaseController.php';
include PATH_CONTROLLER.'EmpresaController.php';
$empresa = new Empresa();
$emp = $empresa->getByiD(1);

if(!empty($emp[0])){
    define ('RIF', ''.$emp[0]->rif_emp.'');
    define ('EMPRESA', ''.$emp[0]->nom_emp.'');
    define ('DIR_EMPRESA', ''.$emp[0]->dir_emp.'');
    define ('TELF_EMPRESA',''.$emp[0]->tlf_emp.'');
    define ('IVA', ''.$emp[0]->iva.'');
    define ('LOGO', ''.$emp[0]->url_logo.'');
}
else {
    define ('RIF', '123456');
    define ('EMPRESA', 'NOMBRE DE EMPRESA');
    define ('DIR_EMPRESA', 'DIRECCION EMPRESA');
    define ('TELF_EMPRESA', '0414-123456');
    define ('IVA', 15);
    define ('LOGO', FOLDER.'/public/imagenes/logo.png');

}
?>
