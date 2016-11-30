<?php
require('inc/config.php');

// извличане на информация от страницата
$memberID = trim($_GET['x']);
$active = trim($_GET['y']);

// ако ид-то е номер и активният токен не е празен да продължи
if(is_numeric($memberID) && !empty($active)){

	// да упдейтне потребителският запис и да сложи да на memberID
	$stmt = $db->prepare("UPDATE members SET active = 'Yes' WHERE memberID = :memberID AND active = :active");
	$stmt->execute(array(
		':memberID' => $memberID,
		':active' => $active
	));

	// ако редицата е упдейтната да редиректне потребителят
	if($stmt->rowCount() == 1){

		// редирект към логин страницата
		header('Location: login.php?action=active');
		exit;

	} else {
		echo "Потребителят Ви не можеше да бъде активиран."; 
	}
	
}
?>