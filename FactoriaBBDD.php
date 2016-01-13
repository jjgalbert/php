<?php

require_once "TiposBBDD.php";
require_once "ModeloBBDD_Mongo.php";
require_once "ModeloBBDD_MYSQL.php";

class factoriaBBDD{
    static $modelos = array(TiposBBDD::MYSQL=>null, TiposBBDD::MONGODB=>null);
    

    public static function getModeloBBDD($_tipoModelo){
        if (is_null($_tipoModelo))
            throw new Exception ("Tipo de modelo de bbdd nulo", 1);
        if (!is_null(FactoriaBBDD::$modelos[$_tipoModelo])){
            echo "Hace patrón \n";
            return FactoriaBBDD::$modelos[$_tipoModelo];
        }
        switch ($_tipoModelo) {
            case TiposBBDD::MONGODB:
                FactoriaBBDD::$modelos[TiposBBDD::MONGODB] = new ModeloBBDD_Mongo();
                return FactoriaBBDD::$modelos[TiposBBDD::MONGODB];
                break;
            
            default:
                FactoriaBBDD::$modelos[TiposBBDD::MYSQL] = new ModeloBBDD_MYSQL();
                return FactoriaBBDD::$modelos[TiposBBDD::MYSQL];
                break;
        }
    }
}

?>