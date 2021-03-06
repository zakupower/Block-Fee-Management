<?php require('inc/config.php');
// ако потребителят е логнат да бъде прехвърлен на друга страница
if( $user->is_logged_in() ){ header('Location: memberpage.php'); }

// ако формата е изпратена да се изпълни
if(isset($_POST['submit'])){

	// много проста форма на валидация
	if(strlen($_POST['username']) < 3){
		$error[] = 'Името е твърде късо.';
	} else {
		$stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
		$stmt->execute(array(':username' => $_POST['username']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['username'])){
			$error[] = 'Името което въведохте вече се използва.';
		}

	}

	if(strlen($_POST['password']) < 3){
		$error[] = 'Паролата е твърде къса.';
	}

	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Потвърждаващата парола е твърде къса.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Въведените пароли не съвпадат.';
	}

	// e-mail валидиране
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Моля въведете валидна електронна поща';
	} else {
		$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['email'])){
			$error[] = 'Електронна поща която въведохте вече се използва.';
		}

	}


	// ако няма грешки да продължи
	if(!isset($error)){

		// hash на паролата
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

		// създаване на активационният код
		$activasion = md5(uniqid(rand(),true));

		try {

			// изпращане към базата данни
			$stmt = $db->prepare('INSERT INTO members (username,password,email,active) VALUES (:username, :password, :email, :active)');
			$stmt->execute(array(
				':username' => $_POST['username'],
				':password' => $hashedpassword,
				':email' => $_POST['email'],
				':active' => $activasion
			));
			$id = $db->lastInsertId('memberID');

			// изпращане на електронна поща
			$to = $_POST['email'];
			$subject = "Нов домоуправител";
			$body = "<p>В системата се регистрира нов домоуправител с име: ." .$_POST['username']."</p>
			<p>Електронна поща: " .$_POST['email']."</p>
			<p>За да потвърдите новата регистрация моля кликнете на този линк: <a href='".DIR."activate.php?x=$id&y=$activasion'>".DIR."activate.php?x=$id&y=$activasion</a></p>
			<p>Regards Block-Management Team</p>";

			$mail = new Mail();
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->send();

			// редирект към логин страницата
			header('Location: index.php?action=joined');
			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}
	}
}

// Титла на страницата
$title = 'Block-Management';

// включване нa хийдъра
require('inc/header.php');
?>


<div class="container">
	<div class="row">
	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Регистрация за домоуправител</h2>
				<p>Ако сте регистриран натиснете <a href='login.php'>тук</a></p>
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				//if action is joined show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'joined'){
					echo "<h2 class='bg-success'>Регистрацията е успешна, моля изчакайте потвърждение от администратора.</h2>";
				}
				?>

				<div class="form-group">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Име" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
				</div>
				<div class="form-group">
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Електронна поща" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="2">
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Парола" tabindex="3">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Потвърди..." tabindex="4">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Регистрирай ме" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
// включване нa футъра :D
require('inc/footer.php');
?>
