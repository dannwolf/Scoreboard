<?php
include ROOT."models".DS."stats.php";
include ROOT."models".DS."drivers.php";
include ROOT."models".DS."periodos.php";
include ROOT."models".DS."scores.php";

class DriversController  extends AppController{
  public function __construct(){
    parent::__construct();

  }
  public function index(){
    $drivers = Drivers::obtenerTodos();

    $this->set("drivers", $drivers);
  }

  public function agregar(){
    if($_POST){
      
      if (Drivers::guardar($_POST)) {
        $this->set("flashMessage", "Driver guardado correctamente");
        $this->redirect(array(
          "controller"=>"drivers",
          "action"=>"index"
        ));   
      } else {
        $this->redirect(array(
          "controller"=>"drivers",
          "action"=>"agregar"
        ));
      }
    } else {
      $drivers = Drivers::obtenerTodos();
      $this->set("drivers", $drivers);
    }
  }

  public function editar($id){
    if ($_POST) {
      if (Drivers::guardar($_POST)) {
        $this->set("flashMessage", "Driver actualizado correctamente");
        $this->redirect(array(
          "controller"=>"drivers",
          "action"=>"index"
        ));
        
      } else {
        $this->redirect(array(
          "controller"=>"drivers",
          "action"=>"editar",
          "args"=>$_POST["id"]
        ));
      }
    } else {
      $driver = Drivers::buscarPorId($id);
      $this->set(compact("driver"));
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

    if (!isset($id)|| empty($driver= Drivers::buscarPorId($id))) {
      $this->set("flashMessage","Driver no econtrado");
      $this->redirect(array(
          "controller"=>"drivers",
          "action"=>"editar"
        ));
    }else{
        if ($driver =Drivers::eliminarPorId($id)) {
          $this->set("flashMessage","Driver eliminado correctamente");  
        }else{
          $this->set("flashMessage","El driver no puede ser eliminado, elimina los stats relacionados");
        }
        $this->redirect(array(
          "controller"=>"drivers",
          "action"=>"index"
        ));
    }
  }
}


?>