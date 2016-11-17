<?php
class Encoder
{
    public $conn = null;

    public function encode($str) {
        $code = strtoupper(substr(md5($str),-6));
        return $code;
    }
    public function searchIfExist($DB_HOSTNAME,$DB_DATABASE,$DB_USERNAME,$DB_PASSWORD,$code) {
        try {
            //db
            $this->conn = new PDO("mysql:host=".$DB_HOSTNAME.";dbname=".$DB_DATABASE."",$DB_USERNAME,$DB_PASSWORD);
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
                return "Exist";
            }
            else {
                return $code;
            }


        }
        catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}

/*
$encoder = new Encoder();
$code = $encoder->encode("0107");
echo $encoder->searchIfExist("localhost","apps","root","",$code);
*/
?>
