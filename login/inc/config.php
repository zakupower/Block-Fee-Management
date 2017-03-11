<?php
ob_start();
session_start();

//set timezone
date_default_timezone_set('Europe/Sofia');

//database credentials
define('DBHOST','localhost');
define('DBUSER','');
define('DBPASS','');
define('DBNAME','');

//application address
define('DIR','http://block.selendis.pw/');
define('SITEEMAIL','no-reply@block.selendis.pw');

try {

	//create PDO connection
	$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection
require('user.php');
require('phpmailer/mail.php');
$user = new User($db);
?>
