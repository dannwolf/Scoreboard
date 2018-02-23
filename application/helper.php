<?php
/**
 *
 */
class Helper
{
  protected $_controller;
  protected $_method;

  public function __construct()
  {
    $petition = new Request();
    $this->_controller = $petition->getControlador();
    $this->_method = $petition->getMetodo();

  }
}
/**
 *
 */
class Html extends Helper
{

  public function __construct()
  {
    parent::__construct();
  }
  public function link(
    $title,
    $url = null,
    $options  = array()
    ){
    $attributes = "";
    if (is_array($url)) {
      if (!empty($url["controller"]) and
          !empty($url["method"])
        ) {
        $path = "/".implode("/", $url);
      }else if (!empty($url["controller"])) {
        $path = "/".$url["controller"].$this->_method;
        if (!empty($url["args"])) {
          $path .= "/".$url["args"];
        }
      }else if (!empty($url["method"])) {
        $path = "/".$this->_controller.$url["method"];
        if (!empty($url["args"])) {
          $path .= "/".$url["args"];
        }
      }
    }else {
      $path = $url;
    }
    if (!empty($options["title"])) {
      $attributes = "title=\"".$options["title"]."\"";
    }
    if (!empty($options["id"])) {
      $attributes .= "id=\"".$options["id"]."\"";
    }
    if (!empty($options["class"])) {
      $attributes .= "class=\"".$options["class"]."\"";
    }
    if (!empty($options["target"])) {
      if (empty($attributes)){
        $attributes = "target=\"".$options["target"]."\"";
    }else {
      $attributes = " target=\"".$options["target"]."\"";
    }
  }
  
  
  $link = "<a href=\"".APP_URL.$path."\" ".$attributes.">".$title."</a>";
  return $link;
  }

  public function prioridad($prioridad){
    $label="label";
    if($prioridad>=8){
       $span='<td align="center"><span class="label label-danger">Alta&nbsp;&nbsp;&nbsp;</span></td>';

    }elseif ($prioridad>=5) {
        $span='<td align="center"><span class="label label-warning">Media</span></td>';
    }else{
        $span='<td align="center"><span class="label label-susses">Baja&nbsp;&nbsp;&nbsp;</span></td>';
    }
    return $span;
  }

  public function formatoFecha($fecha){
    $newFecha=date("d/m/Y",strtotime($fecha));
    return $newFecha;
  }
}

?>
