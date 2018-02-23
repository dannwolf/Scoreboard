<?php
/**
 *
 */
class scores{
  private static $nombre = "scores";

  public static function obtenerTodos(){

    $score = Database::obtenerInstancia();

    $sql = "SELECT * FROM ".self::$nombre."
    ";
    $resultado = $score->query($sql);


    foreach (range(0, $resultado->columnCount()-1) as $column_index) {
      $meta[] = $resultado->getColumnMeta($column_index);

    }

    $resultados = $resultado->fetchAll(PDO::FETCH_NUM);

    for ($i=0; $i < count($resultados); $i++) {
      $j=0;
      foreach($meta as $value) {
        $rows[$i][$value["table"]][$value["name"]] = $resultados[$i][$j];
        $j++;
      }
    }
    return $rows;
  }
  public static function guardar($datos=array()){
    $score = Database::obtenerInstancia();
    
    if (isset($datos["id"])) {
      //si el id existe quiere decir que estamos actualizando
      $consulta = $score->prepare("UPDATE ".self::$nombre." SET drivers_id=:drivers_id, stats_id=:stats_id ,periodos_id=:periodos_id , valor=:valor,fecha=:fecha WHERE id=:id");
      $consulta->bindParam(":id", $datos["id"]);
      $consulta->bindParam(":drivers_id", $datos["drivers_id"]);
      $consulta->bindParam(":stats_id", $datos["stats_id"]);
      $consulta->bindParam(":periodos_id", $datos["periodos_id"]);
      $consulta->bindParam(":valor", $datos["valor"]);
      $consulta->bindParam(":fecha", $datos["fecha"]);
      if ($consulta->execute()) {
         return true;
      }else{
        return false;
      }
    } else {
      //en caso de no pasar id se hace un registro nuevo
      $consulta = $score->prepare("INSERT INTO ".self::$nombre.
        " (drivers_id, stats_id, periodos_id, valor, fecha)
          VALUES (:drivers_id, :stats_id, :periodos_id, :valor, :fecha)");
      $consulta->bindParam(":drivers_id", $datos["drivers_id"]);
      $consulta->bindParam(":stats_id", $datos["stats_id"]);
      $consulta->bindParam(":periodos_id", $datos["periodos_id"]);
      $consulta->bindParam(":valor", $datos["valor"]);
      $consulta->bindParam(":fecha", $datos["fecha"]);
      if ($consulta->execute()) {
        return true;
      } else {
        return false;
      }
      

    }
  }

  public static  function buscarPorDriverPeriodo(){
    $score = Database::obtenerInstancia();

    $sql = "SELECT * FROM scores, drivers, stats, periodos where drivers.id=scores.drivers_id and stats.id=scores.stats_id and scores.periodos_id=periodos.id";

    $resultado = $score->query($sql);


    foreach (range(0, $resultado->columnCount()-1) as $column_index) {
      $meta[] = $resultado->getColumnMeta($column_index);

    }

    $resultados = $resultado->fetchAll(PDO::FETCH_NUM);

    for ($i=0; $i < count($resultados); $i++) {
      $j=0;
      foreach($meta as $value) {
        $rows[$i][$value["table"]][$value["name"]] = $resultados[$i][$j];
        $j++;
      }
    }
    return $rows;    
  }


  public static function eliminarPorId($id)
  {
    $score = Database::obtenerInstancia();
    $consulta = $score->prepare("DELETE FROM ".self::$nombre." WHERE id=:id");
    $consulta->bindParam(":id", $id);  
     if ($consulta->execute()) {
         return true;
      }else{
        return false;
      }
  }

  public static function buscarPorId($id){
    $score = Database::obtenerInstancia();
    $consulta = $score->prepare("SELECT * FROM ".self::$nombre." WHERE id=:id");
    $consulta->bindParam(":id", $id);
    $consulta->execute();
    $registro = $consulta->fetch();
    if ($registro) {
      return $registro;
    } else {
      return false;

    }
  }



 }
?>