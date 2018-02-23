<?php

/**
 *
 */
class Drivers {
  private static $nombre = "drivers";

  public static function obtenerTodos(){
    $driver = Database::ObtenerInstancia();

    $sql = "SELECT * FROM ".self::$nombre;

    $resultado = $driver->query($sql);

 foreach (range(0, $resultado->columnCount()-1) as $column_index) {
      $meta[] = $resultado->getColumnMeta($column_index);

    }

    $resultados = $resultado->fetchAll();

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
    $driver = Database::obtenerInstancia();
    
    if (isset($datos["id"])) {
      //si el id existe quiere decir que estamos actualizando
      $consulta = $driver->prepare("UPDATE ".self::$nombre." SET nombre=:nombre, foto=:foto WHERE id=:id");
      $consulta->bindParam(":id", $datos["id"]);
      $consulta->bindParam(":nombre", $datos["nombre"]);
      $consulta->bindParam(":foto", $datos["foto"]);
      if ($consulta->execute()) {
         return true;
      }else{
        return false;
      }

    } else {
      //en caso de no pasar id se hace un registro nuevo
      $consulta = $driver->prepare("INSERT INTO ".self::$nombre.
        " (nombre,foto)
          VALUES (:nombre,:foto)");
      $consulta->bindParam(":nombre", $datos["nombre"]);
      $consulta->bindParam(":foto", $datos["foto"]);
      if ($consulta->execute()) {
        return true;
      } else {
        return false;
      }
   }
  }

  public static function eliminarPorId($id)
  {
    $sql = Database::obtenerInstancia();
    $tabla="stats";
    $sql->query("SELECT * FROM ".$tabla." INNER JOIN drivers
    ON stats.driver_id = drivers.id WHERE stats.driver_id=".$id."");

    $validar=mysqli_affected_rows($sql);
    if ($validar==0) {
      $consulta = $sql->prepare("DELETE FROM ".self::$nombre." WHERE id=:id");
      $consulta->bindParam(":id", $id);  
       if ($consulta->execute()) {
        return true;
      } else {
        return false;
      }
    }else{
      return false;
    } 
  }


  public static function buscarPorId($id){
    $driver = Database::obtenerInstancia();
    $consulta = $driver->prepare("SELECT * FROM ".self::$nombre." WHERE id=:id");
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
