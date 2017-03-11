<?php require('inc/config.php'); 

// проверка дали е сте логнат и да го прехвърли на друга страница
if( $user->is_logged_in() ){ header('Location: home.php'); } 

$stmt = $db->prepare('SELECT resetToken, resetComplete FROM users WHERE resetToken = :token');
$stmt->execute(array(':token' => $_GET['key']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// ако няма токен от базата данни да убие страницата
if(empty($row['resetToken'])){
	$stop = ' Този линк не е валиден. Моля използвайте линкът от електронната ви поща.';
} elseif($row['resetComplete'] == 'Yes') {
	$stop = ' Паролата ви вече е сменена!';
}

// ако формата е изпратена да се изпълни
if(isset($_POST['submit'])){

	// проста валидация
	if(strlen($_POST['password']) < 3){
		$error[] = 'Паролата е твърде кратка.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Паролите не съвпадат.';
	}

	// ако няма грешки да продължи
	if(!isset($error)){

		// hash на паролата
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

		try {

			$stmt = $db->prepare("UPDATE users SET password = :hashedpassword, resetComplete = 'Yes'  WHERE resetToken = :token");
			$stmt->execute(array(
				':hashedpassword' => $hashedpassword,
				':token' => $row['resetToken']
			));

			// редирект към индекс страницата
			header('Location: /login.php?action=resetAccount');
			exit;

		// ако има грешки да ги покаже
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}

	}

}
?>

<div class="container">
	<div class="row">
	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">


	    	<?php if(isset($stop)){
				echo "<br>";
	    		echo "<p class='bg-danger'>$stop</p>";

	    	} else { ?>

				<form role="form" method="post" action="" autocomplete="off">
					<h2>Въведете нова парола</h2>
					<hr>

					<?php
					// проверка за грешки
					if(isset($error)){
						foreach($error as $error){
							echo '<p class="bg-danger">'.$error.'</p>';
						}
					}

					// проверка на изпратените данни
					switch ($_GET['action']) {
						case 'active':
							echo "<h3 class='bg-success'>Вашият профил вече е активиран.</h3>";
							break;
						case 'reset':
							echo "<h3 class='bg-success'>Моля проверете си електронната поща за смяна на паролата.</h3>";
							break;
					}
					?>

					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Парола" tabindex="1">
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Повторна парола" tabindex="1">
							</div>
						</div>
					</div>
					
					<hr>
					<div class="row">
						<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Смени" class="btn btn-primary btn-block btn-lg" tabindex="3"></div>
					</div>
				</form>

			<?php } ?>
		</div>
	</div>
</div>
