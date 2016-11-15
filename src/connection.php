<?php
/* da ne zabravim chmod 644 na config.php */
require ("config.php");

class Database {

    public $conn = null;


    public function connect()
    {
      try
      {
          $this->conn = new PDO("mysql:host=".DB_HOSTNAME.";dbname=".DB_DATABASE."",DB_USERNAME,DB_PASSWORD);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(PDOException $e)
      {
          echo $e->getMessage();
      }
      return $this->conn;
    }
}
?>
