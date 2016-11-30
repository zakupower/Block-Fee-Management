<?php require('inc/config.php');
// логайут
$user->logout(); 
// ако е логнат да се прехвърли
header('Location: index.php');
exit;
?>