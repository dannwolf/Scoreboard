<?php
/**
 *
 */

class View {
  private $_controlador;
  private $_metodo;
  private $_view;
  private $layout = DEFAULT_LAYOUT;
  private $viewVars;
  public $helper = array("Html");

  public function __construct(Request $peticion){
    $this->_controlador = $peticion->getControlador();
    $this->_metodo = $peticion->getMetodo();
    $this->_view = $this->_metodo;
    $this->loadHelper();

  }
  public function setLayout($layout)
  {
    $this->_layout = $layout;

  }
  public function setVars($vars){
    if (empty($this->viewVars)) {
      $this->viewVars = $vars;
    }else {
      $this->viewVars = array_merge($this->viewVars, $vars);
    }
  }
  public function render($view)
  {
    if (!empty($this->viewVars)) {
      extract($this->viewVars, EXTR_OVERWRITE);
    }
    $layoutParams = array(
      "route_layout" => APP_URL."/views/layouts".$this->layout,
      "route_css" => APP_URL."/views/layouts/".$this->layout."/css",
      "route_img" => APP_URL."/views/layouts/".$this->layout."/img",
      "route_js" => APP_URL."/views/layouts/".$this->layout."/js"
    );
    $routeView = ROOT."views".DS.$this->_controlador.DS.$view.".phtml";
    $header = ROOT."views".DS."layouts".DS.$this->layout.DS."header.php";
    $footer = ROOT."views".DS."layouts".DS.$this->layout.DS."footer.php";

    if (is_readable($routeView)) {
      include_once($header);
      include_once($routeView);
      include_once($footer);
    }else {
      throw new Exception("La vista para el metodo $this->_metodo", 1);
    }
  }
  public function loadHelper(){
    if (!empty($this->helper)) {
      foreach ($this->helper as $key => $value) {
        $this->$value = new $value;
      }
    }
  }
  public function __destruct()
  {
    $this->render($this->_view);
  }
}
?>
