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
define ('FOLDER', 'http://localhost:8080/pg24');
define ('CSS', '/css');
define ('VIEWS', '../views');

/*
 errores
 */

define ('ERROR_REPORTING_LEVEL', 1);

/*
 empresa
 */
include 'core/Conectar.php';
include 'core/EntidadBase.php';
include 'core/BaseController.php';
include PATH_CONTROLLER.'EmpresaController.php';
$empresa = new Empresa();
$emp = $empresa->getByiD(1);

if(!empty($emp[0])){
    define ('RIF', '123213');
    define ('EMPRESA', ''.$emp[0]->nom_emp.'');
    define ('DIR_EMPRESA', ''.$emp[0]->dir_emp.'');
    define ('TLF_EMP', ''.$emp[0]->tlf_emp.'');
    define ('IVA', ''.$emp[0]->iva.'');

}
else {
    define ('RIF', '123456789-0');
    define ('EMPRESA', 'NOMBRE DE EMPRESA');
    define ('DIR_EMPRESA', 'DIRECCION');
    define ('TLF_EMP', '123456789-0');
    define ('IVA', 15);

}
?>
