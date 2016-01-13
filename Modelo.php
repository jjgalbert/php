<?php

class Modelo {
    var $id;
    var $fecha;
    var $estado;
    function Modelo($_id, $id_partido, $_fecha, $_estado ){
        if is_null($_id)
            throw new Exception("ID Vacío", 1);
        $this->id = $_id;
        $this->fecha = $_fecha;
        $this->estado = $_estado;
    }

    function getFecha(){
        return $fecha;
    }

    function getEstado(){
        return $estado;
    }

    function getID(){
        return $id;
    }

    function setEstado($_estado){
        $this->estado = $_estado;
    }

    function setFecha($_fecha){
        $this->fecha = $_fecha;
    }
}

?>
