<?php require('inc/config.php');

// проверка дали е сте логнат и да го прехвърли на друга страница
if( $user->is_logged_in() ){ header('Location: home.php'); }

// ако формата е изпратена да се изпълни
if(isset($_POST['submit'])){

	// e-mail валидация
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Моля въведете валидна електронна поща';
	} else {
		$stmt = $db->prepare('SELECT email FROM users WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(empty($row['email'])){
			$error[] = 'Няма потребител с тази електронна поща.';
		}

	}
	// ако няма грешки да продължи
	if(!isset($error)){

		// създаване на активационният код
		$token = md5(uniqid(rand(),true));

		try {

			$stmt = $db->prepare("UPDATE users SET resetToken = :token, resetComplete='No' WHERE email = :email");
			$stmt->execute(array(
				':email' => $row['email'],
				':token' => $token
			));

			// изпращане на e-mail
			$to = $row['email'];
			$subject = "Смяна на парола";
			$body = "<p>Някой е поискал смяна на паролата на домоуправител.</p>
			<p>Ако това е грешка може игнорирайте тази поща и нищо няма да се случи.</p>
			<p>За да смените паролата моля посетете следният адрес: <a href='".DIR."newpassword.php?key=$token'>".DIR."newpassword.php?key=$token</a></p>";

			$mail = new Mail();
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->send();
			// редирект към индекс страницата
			header('Location: login.php?action=reset');
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
			<form role="form" method="post" action="" autocomplete="off">
				<h2 style="bottom-margin:10">Въведете вашата електронна поща</h2>
				<hr>

				<?php
				// проверка за грешки
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				if(isset($_GET['action'])){
					// проверка на изпратените данни
					switch ($_GET['action']) {
						case 'active':
							echo "<h3 class='bg-success'>Вашият профил вече е активиран.</h3>";
							break;
						case 'reset':
							echo "<h3 class='bg-success'>Моля проверете вашата електронна поща за смяна на паролата.</h3>";
							break;
					}
				}
				?>

				<div class="form-group">
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Електронна поща" value="" tabindex="1">
				</div>
				<hr>
				<div class="row">
					<div class="col-xs-6 col-md-6 col-lg-6"><input type="submit" name="submit" value="Изпрати" class="btn btn-primary btn-block btn-lg" tabindex="2"></div>
			</form>
			<div class="col-xs-6 col-md-6 col-lg-6"><form action="/login.php">
			<input type="submit" name="back" value="Обратно" class="btn btn-primary btn-block btn-lg" tabindex="3">
				</form></div>
			
				</div>
		</div>
	</div>
</div>