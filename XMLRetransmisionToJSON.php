<?php
class XMLRetransmisionToJSON{
    public static function toJSON($_file){
        try{
            $xml = simplexml_load_file($_file);
            $json = json_encode($xml);
            return $json;
        }
        catch (Exception $e){
            die ("Error gordo: " . $e->getMessage());
        }
    }
}
?>