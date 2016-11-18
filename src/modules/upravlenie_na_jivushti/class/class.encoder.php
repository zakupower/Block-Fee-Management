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
    public function searchIfExist($code) {
        $database = new Database();
        $database->query('SELECT * FROM unique_ID');
        $row = $database->resultset();
        //print_r($row);

        for ($i=0; $i < $database->rowCount(); $i++) {
            if($row[$i]['unique_ID'] == $code) {
                return true;
            }
        }
    }
}

/*
 $enc = new Encoder();
 if($enc->searchIfExist("334EC81")) {
     echo "exist";
 }
 else {
     echo "not exist";
 }
*/
?>
