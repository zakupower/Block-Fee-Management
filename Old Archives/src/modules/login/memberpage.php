<?php require('inc/config.php'); 
// ако не е логнат да се прехвърли към логин страницата
if(!$user->is_logged_in()){ header('Location: login.php'); } 

// Титла на страницата
$title = 'Block-Management: Меню';

// включване нa хийдъра
require('inc/header.php'); 
?>

<div class="container">
	<div class="row">
	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">			
				<h2>Само за домоуправители - Добре дошъл <?php echo $_SESSION['username']; ?></h2>
				<p><a href='logout.php'>Изход</a></p>
				<hr>
		</div>
	</div>
</div>

<?php 
// включване нa футъра :D
require('inc/footer.php'); 
?>
