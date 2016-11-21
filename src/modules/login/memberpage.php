<?php require('includes/config.php'); 

// ако не е логнат да си ходи към логин-а :)
if(!$user->is_logged_in()){ header('Location: login.php'); } 

// Титла
$title = 'Block-Management: Меню';

// хийдър
require('layout/header.php'); 
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
// футър
require('layout/footer.php'); 
?>
