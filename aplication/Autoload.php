<?php

/**
* Se encarga de la carga de las librerias.
*/
function __autoload($name)
{
	require_once ROOT."libs".DS.$name.".php";
}