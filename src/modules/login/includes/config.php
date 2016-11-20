<?php
ob_start();
session_start();

// админнистратора който ще одобрява всичко домоуправители
$adminEmail = "mmdollar@gmail.com";

// да си сложим и нашата времева зона :)
date_default_timezone_set('Europe/Sofia');

//database credentials
define('DBHOST','localhost');
define('DBUSER','test');
define('DBPASS','testtest');
define('DBNAME','test_db');

// адреси на системата
define('DIR','http://block.selendis.pw/');
define('SITEEMAIL','no-reply@block.selendis.pw');

try {

	// създаваме PDO връзка
	$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	// показване на грешки
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

// include include include :D
include('classes/user.php');
include('classes/phpmailer/mail.php');
$user = new User($db);
?>
