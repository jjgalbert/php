<?php

require_once "./FactoriaBBDD.php";
require_once "./TiposBBDD.php";
require_once "./ModeloBBDD.php";

//define("T_BBDD", array('mysql', 'mongodb', 'pgsql'));


class Controlador{
    var $t_bbdd;
    var $modelo;
    function __construct($_t_bbdd){
        if (is_null($_t_bbdd)){
            throw new Exception("Tipo de BBDD no soportado", 1);
        }
        $this->t_bbdd = $_t_bbdd;
        $this->modelo = FactoriaBBDD::getModeloBBDD($_t_bbdd);
    }


    function doConsultasMasivas($_n_consultas = ModeloBBDD::DEFAULT_REGISTROS_READ){
        $tiempo = microtime();
        $this->modelo->getConsultasMasivas($_n_consultas);
        return microtime() - $tiempo;

    }
    function doInserccionesMasivas($_n_consultas = ModeloBBDD::MAX_REGISTROS_ADD){
        $tiempo = microtime();
        $this->modelo->setRegistrosMasivos($_n_consultas);
        return microtime() - $tiempo;var_dump("HHHH");die;
    }

    function doSetRetransmision(){
        $tiempo = microtime();
        $this->modelo->setRetransmision();
        return microtime() - $tiempo;var_dump("HHHH");die;
    }


}

echo "hola\n";
//CargaParcial::cargaElementos();
$options = getopt("n:t:b:");
$n_total = ModeloBBDD::DEFAULT_REGISTROS_READ;
if (array_key_exists("n", $options)){
    $n_total = $options['n'];}


$tipo = "R";
if (array_key_exists("t", $options)){
    $tipo = $options["t"];
}

$bbdd = 'MONGODB';
$db = null;
if (array_key_exists('b', $options)){
    if ($options['b'] == 'MYSQL')
        $db = new Controlador(TiposBBDD::MYSQL);
    else
        $db = new Controlador(TiposBBDD::MONGODB);
}
else 
    $db = new Controlador(TiposBBDD::MONGODB);

if ($tipo == 'W'){
    $tiempo = $db->doInserccionesMasivas($n_total);
}
else 
    $tiempo = $db->doConsultasMasivas($n_total);


echo "\n\n Ha tardado $tiempo msecs en ejecutarlo, o " . ($tiempo / $n_total) . " por cada consulta. \n";

//$mysql = new Controlador(TiposBBDD::MYSQL);


echo "adios\n";

$db->doSetRetransmision();
?>