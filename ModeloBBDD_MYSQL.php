<?php
require_once "ModeloBBDD.php";

class ModeloBBDD_MYSQL extends ModeloBBDD{
  var $id;
  var $conexion;
  const BBDD_NAME = "pruebasbbdd";
  const TABLE_PARTIDO = "partido";
  const TABLE_JORNADA = "jornada";
  const TABLE_GRUPO = "grupo";
  const TABLE_FASE = "fase";
  
  function connect(){
       $this->conexion = $link = mysql_connect('localhost', 'pruebasbbdd', 'pruebasbbdd');
  }

  function getConsultasMasivas($_n_registros = 100){
    mysql_select_db(ModeloBBDD_MYSQL::BBDD_NAME);
    $query = 'SELECT * FROM ' . ModeloBBDD_MYSQL::TABLE_PARTIDO;
    $result = mysql_query($query);

    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
      echo "\t<tr>\n";
      foreach ($line as $col_value) {
          echo "\t\t<td>$col_value</td>\n";
      }
      echo "\t</tr>\n";
    }
    echo "</table>\n";
  }

  function setRegistrosMasivos($_n_competiciones = 1){
    mysql_select_db(ModeloBBDD_MYSQL::BBDD_NAME);
    $query = "delete * from " . ModeloBBDD_MYSQL::TABLE_PARTIDO;
    $result = mysql_query($query);
    $query = "delete * from " . ModeloBBDD_MYSQL::TABLE_JORNADA;
    $result = mysql_query($query);
    $query = "delete * from " . ModeloBBDD_MYSQL::TABLE_GRUPO;
    $result = mysql_query($query);
    $query = "delete * from " . ModeloBBDD_MYSQL::TABLE_FASE;
    $result = mysql_query($query);
    $n_competiciones = 1;
    if ($_n_competiciones <= ModeloBBDD::MAX_COMPETICIONES)
      $n_competiciones = $_n_competiciones;
    $i = 0;
    $partidos_totales = 0;
    for (;$i<$n_competiciones;$i++){
      $n_fases = ModeloBBDD::N_FASES;
      $f = 0;
      for (;$f<$n_fases;$f++){
        $n_grupos = ModeloBBDD::N_GRUPOS_FASE;
        $g = 0;
        for (;$g<$n_grupos;$g++){
          $n_jornadas = ModeloBBDD::N_JORNADAS_GRUPO;
          $j = 0;
          for (;$j<$n_jornadas;$j++){
            $n_partidos = ModeloBBDD::N_PARTIDOS_JORNADA;
            $p = 0;
            for (;$p<$n_partidos;$p++){
              $partidos_totales++;
              $query = 'insert into partido(id_partido, fecha, id_equipo_local, id_equipo_visitante, estado, marcador_local, marcador_visitante, id_jornada) 
              value ('.$partidos_totales.', "'.date("Y-m-d H:i:s").'", '.($p+1).', '.($p+2).', "OK", "1", "2", 1);';
              $result = mysql_query($query);

            }
          }
        }
      }
    }
  }

  function setRetransmision(){
    $json = $this->getJSON();
    var_dump($json);
  }  
}
?>