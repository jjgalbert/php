<?php

require_once "XMLRetransmisionToJSON.php";

abstract class ModeloBBDD{

  var $id;

  var $connection;

  var $json;

  const MAX_REGISTROS_READ = 100000001;
  const MAX_REGISTROS_ADD = 100000001;
  const DEFAULT_REGISTROS_READ = 100;
  const N_PARTIDOS_JORNADA = 10;
  const N_JORNADAS_GRUPO = 40;
  const N_GRUPOS_FASE = 1;
  const N_FASES = 1;
  const MAX_COMPETICIONES = 1000;
  const XML_RETRANS_FILE = "/home/jjgarcia/Documentos/desarrollo/as/desarrollo_local/pruebas/php/pruebas_bbdd/datos/xml/retransmision.xml";

  function __construct(){
    $this->connect();
  }

  function setId($_id){
    if (is_null($_id)) throw new Exception("ID Vacío");
    $this->id = $_id;
  }

  abstract protected function connect();
  abstract protected function getConsultasMasivas($_n_consultas = 100);
  abstract protected function setRegistrosMasivos($_n_competiciones = 1);
  abstract protected function setRetransmision();
  protected function getJSON(){
    return XMLRetransmisionToJSON::toJSON(ModeloBBDD::XML_RETRANS_FILE);
  }
}
?>