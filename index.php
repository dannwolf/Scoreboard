<?php
//Aqui utilizamos front controller
//Constante que contiene el separador de directorio en windows.
define("DS", DIRECTORY_SEPARATOR);

define("ROOT", realpath(dirname(__FILE__)).DS);
//Carpeta en donde esta la app
define("APP_PATH", ROOT."application".DS);

require_once (APP_PATH."config.php");
require_once (APP_PATH."database.php");
require_once (APP_PATH."request.php");
require_once (APP_PATH."bootstrap.php");
require_once (APP_PATH."autoload.php");
require_once (APP_PATH."controller.php");
require_once (APP_PATH."model.php");
require_once (APP_PATH."view.php");
require_once (APP_PATH."helper.php");

try {
  Bootstrap::run(new Request);
} catch (Exception $e) {
  echo $e->getMessage();
}

//echo "<pre>";
//print_r(get_required_files());



 ?>
