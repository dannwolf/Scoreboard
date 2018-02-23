<?php
/**
 *
 */
class Bootstrap
{
   public static function run(Request $peticion){
    $controller = $peticion->getControlador()."Controller";
    $rutaControlador  = ROOT."controllers".DS.$controller. ".php";
    $metodo = $peticion->getMetodo();
    $args = $peticion->getArgumentos();

    if (is_readable($rutaControlador)) {
      require_once($rutaControlador);

      $controlador = new $controller;

      if (is_callable(array($controlador, $metodo))) {
        $metodo = $peticion->getMetodo();
      }else {
        $metodo = "index";
      }
      if (isset($args)) {
        call_user_func_array(array($controlador, $metodo),$args);
      }else {
        call_user_func(array($controlador, $metodo));
      }

    }else {
      throw new Exception("Controlador no encontrado");

    }
  }
}
?>
