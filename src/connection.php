<?php
/* da ne zabravim chmod 644 na config.php */
require ("config.php");
public class DatabaseConnect {
  function __construct()
  {
      mysql_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD) or die('Could not connect to MySQL/MariaDB server.');
      mysql_select_db(DB_DATABASE);
  }
}
?>
