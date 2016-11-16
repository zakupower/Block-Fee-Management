<?php

//config file
//require_once "connection.php"
define (DB_USERNAME, "root");
define (DB_PASSWORD, "");
define (DB_DATABASE, "apps");
define (DB_HOSTNAME, "localhost");

class Encoder
{
    public $conn = null;


    public function encode($str) {

        //generatora na kod
        $code = strtoupper(substr(md5($str),-6));

        //edit teq sus tva ot connection.php dannite
        try {
            //db
            $this->conn = new PDO("mysql:host=".DB_HOSTNAME.";dbname=".DB_DATABASE."",DB_USERNAME,DB_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //search query-to
            $sql="SELECT * FROM `unique_ID` WHERE (`unique_ID` LIKE :code)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindparam(":code", $code);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $arr = array();
            if(!empty($result)) {
                foreach( $result as $row ) {
                    $arr = $row['unique_ID'];
                }
            }
            if($arr == $code) {
                echo "Kodat e veche generiran generirai otnovo";
            }
            else {
                echo $code;
            }
        }
        catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}

$encoder = new Encoder();
$encoder->encode("0108");

?>
