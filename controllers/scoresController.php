<?php
include ROOT."models".DS."scores.php";
include ROOT."models".DS."drivers.php";
include ROOT."models".DS."stats.php";
include ROOT."models".DS."periodos.php";

class ScoresController  extends AppController{
  public function __construct(){
    parent::__construct();

  }
  public function index(){
    $scores = Scores::buscarPorDriverPeriodo();
    $drivers = Drivers::obtenerTodos();
    $stats = Stats::obtenerTodos();
    $periodos = Periodos::obtenerTodos();

    $this->set("scores",$scores);
    $this ->set("drivers",$drivers);
    $this->set("stats",$stats);
    $this ->set("periodos",$periodos);
  }

  public function agregar(){
    if($_POST){
      
      if (Scores::guardar($_POST)) {
        $this->set("flashMessage", "Score guardado correctamente");
        $this->redirect(array(
          "controller"=>"scores",
          "action"=>"index"
        ));        
     } else {
        $this->redirect(array(
          "controller"=>"scores",
          "action"=>"agregar"
        ));
      }
    } else {
      $stats = Stats::obtenerTodos();
      $periodos = Periodos::obtenerTodos();
      $drivers = Drivers::obtenerTodos();     
      $this->set("drivers", $drivers);
      $this->set("stats",$stats);
      $this ->set("periodos",$periodos);
    }
  }

  public function editar($id){
    if ($_POST) {
      if (Scores::guardar($_POST)) {
        $this->set("flashMessage", "Score actualizado correctamente");
        $this->redirect(array(
          "controller"=>"scores",
          "action"=>"index"
        ));   
      } else {
        $this->redirect(array(
          "controller"=>"scores",
          "action"=>"editar",
          "args"=>$_POST["id"]
        ));
      }
    } else {
      $score = Scores::buscarPorId($id);
      $drivers = Drivers::obtenerTodos();
      $stats = Stats::obtenerTodos();
      $periodos = Periodos::obtenerTodos();
      $this->set(compact("score","drivers","stats","periodos"));

      
    } 
  }
  public function eliminar($id){
   /* if($_GET){
       if (Tareas::eliminar($id)) {
        $this->redirect(array(
          "controller"=>"tareas",
          "action"=>"index"
        ));
        } else {
          $this->set("flashMessage", "No se puede elimnar");
      }
    }else{
      $categorias = Categorias::obtenerTodos();

      $this->set("categorias", $categorias);
    }   */
    if (!isset($id)|| empty($score= Scores::buscarPorId($id))) {
      $this->set("flashMessage","Score no econtrado");
      $this->redirect(array(
          "controller"=>"scores",
          "action"=>"index"
        ));
    }else{
        if ($score =Scores::eliminarPorId($id)) {
          $this->set("flashMessage","Score eliminado correctamente");
        }else{
          $this->set("flashMessage","El score no pudo ser eliminado");
        }
        $this->redirect(array(
          "controller"=>"scores",
          "action"=>"index"
        ));
    }
  }
}


?>