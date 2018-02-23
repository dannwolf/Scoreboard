<?php
/**
 *
 */
class Request
{
  //Atributos de la clase.
  private $_controlador;
  private $_metodo;
  private $_argumentos;

  public function __construct(){
    if (isset($_GET["url"])) {
      $url = filter_input(INPUT_GET, "url", FILTER_SANITIZE_URL);
      $url = explode("/", $url);
      $url = array_filter($url);

      //Controlador/Metodo/arg1/arg2/arg3/.....
      $this->_controlador = strtolower(array_shift($url));
      $this->_metodo      = strtolower(array_shift($url));
      $this->_argumentos   = $url;
    }
    if (!isset($this->_controlador)) {
      $this->_controlador = DEFAULT_CONTROLLER;
    }
    if (!isset($this->_metodo)) {
      $this->_metodo = "index";
    }
    if (empty($this->_argumentos)) {
      $this->_argumentos = array();
    }
  }

  public function getControlador(){
    return $this->_controlador;
  }
  public function getMetodo(){
    return $this->_metodo;
  }
  public function getArgumentos(){
    return $this->_argumentos;
  }
}
?>
