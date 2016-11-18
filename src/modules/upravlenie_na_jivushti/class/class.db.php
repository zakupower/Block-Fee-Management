<?php

//
//Functions:
//Description: 
//

class Db
{

    private $DBH;
    private $STH;


    public function __construct()
    {
        // Connection information
        $host   = 'localhost';
        $dbname = 'apps';
        $user   = 'root';
        $pass   = '';

        // Attempt DB connection
        try
        {
            $this->DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $this->DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Successfully connected to the database!';
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }


    public function query($sql_statement)
    {
        //TODO
        $sql = array(':color' => $sql_statement);
        $this->STH = $this->DBH->prepare("INSERT INTO color_table (color) value ( :color )");
        $this->STH->execute(sql);
    }


    public function __destruct()
    {
        // Disconnect from DB
        $this->DBH = null;
        echo 'Successfully disconnected from the database!';
    }
}





?>
