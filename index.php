<?php

/*

* / linux

* \ windows

*/

define("DS", DIRECTORY_SEPARATOR);

define("ROOT", realpath(dirname(__FILE__)) . DS);

define("APP_PATH", ROOT . "aplication" . DS);

//Imprimir ruta del proyecto

//echo ROOT;

require_once(APP_PATH . "Config.php");

require_once(APP_PATH . "Request.php");

require_once(APP_PATH . "Bootstrap.php");

require_once(APP_PATH . "Controller.php");

require_once(APP_PATH . "Model.php");

require_once(APP_PATH . "View.php");

require_once(APP_PATH . "Database.php");

require_once(APP_PATH . "Autoload.php");

//Comprobar que los archivos se estan cargando correctamente

//echo "<pre>"; print_r(get_required_files());

/*$r = new Request();
echo $r->getControlador()."<br>";
echo $r->getMetodo()."<br>";
print_r($r->getArgs());*/

try
{
	
	Bootstrap::run(new Request);

}
catch(Exception $e)
{

	echo $e->getMessage();

}