<?php
/**
 *
 */
class periodos{
  private static $nombre = "periodos";

  public static function obtenerTodos(){

    $periodo = Database::obtenerInstancia();

    $sql = "SELECT * FROM ".self::$nombre."
    ";
    $resultado = $periodo->query($sql);


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

}
?>