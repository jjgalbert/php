<?php
require_once "ModeloBBDD.php";

class ModeloBBDD_Mongo extends ModeloBBDD{
  var $id;
  var $conexion;
  
  function connect(){
       $this->conexion = new MongoDB\Driver\Manager();
  }

  function getConsultasMasivas($_n_registros = 100){
    $maxRegistros = ModeloBBDD::DEFAULT_REGISTROS_READ;
    if ($_n_registros >0 && $_n_registros < ModeloBBDD::MAX_REGISTROS_READ )
      $maxRegistros = $_n_registros;
    $filter = [];
    $options = [
      'sort' => ['id' => -1],
    ];
    $query = new MongoDB\Driver\Query($filter, $options);
    $i=0;
    for ($i = 0;$i<$maxRegistros;$i++) {
      $cursor = $this->conexion->executeQuery('mensajes.holamundo', $query);
      foreach ($cursor as $document) {
        //var_dump($document);
      }
    }

  }

  


  function setRegistrosMasivos($_n_competiciones = 100){

    $bulk = new MongoDB\Driver\BulkWrite;
    $total = ($_n_competiciones < 0 || $_n_competiciones > ModeloBBDD::MAX_REGISTROS_ADD)?ModeloBBDD::MAX_REGISTROS_ADD:$_n_competiciones;
    $i = 0;
    for (;$i<$total;$i++){
        $bulk->insert(['x' => $i . "-" . rand(0, $total)]);
    }
    $this->conexion->executeBulkWrite('mensajes.holamundo', $bulk);
  }

  function setRetransmision(){

    $bulk = new MongoDB\Driver\BulkWrite;
    $json = $this->getJSON();
    var_dump($json);
  }
}
?>