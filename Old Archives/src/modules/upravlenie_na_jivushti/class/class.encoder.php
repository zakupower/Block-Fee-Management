<?php
//
//Functions: encode , searchIfExist
//Description: generira unikalen nomer
//

require_once "class.db.php";

class Encoder
{
    public $conn = null;

    public function encode($str) {
        $code = strtoupper(substr(md5($str),-6));
        return $code;
    }
    public function searchIfExist($code,$table) {
        $database = new Database();
        $database->query('SELECT * FROM '.$table.'');
        $row = $database->resultset();
        //print_r($row);

        for ($i=0; $i < $database->rowCount(); $i++) {
            if($row[$i][$table] == $code) {
                return true;
            }
        }
    }
}

/*
 $enc = new Encoder();
 if($enc->searchIfExist("334EC8","unique_ID")) {
     echo "exist";
 }
 else {
     echo "not exist";
 }
*/
?>
