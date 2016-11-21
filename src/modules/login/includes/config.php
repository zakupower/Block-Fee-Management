<?php
ob_start();
session_start();
// Конфигурация
//
// електронна поща на администратора който ще одобрява всички домоуправители
$adminEmail = "mmdollar@gmail.com";

// да си сложим и нашата времева зона :)
date_default_timezone_set('Europe/Sofia');

// База данни
define('DBHOST','localhost');
define('DBUSER','митака');
define('DBPASS','цепи');
define('DBNAME','математика');

// адреси на системата
define('DIR','http://block.selendis.pw/');
define('SITEEMAIL','no-reply@block.selendis.pw');

// Край на конфигурацията

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
