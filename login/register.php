
<?php 
// ако потребителят е логнат да бъде прехвърлен на друга страница
if( $user->is_logged_in() ){ header('Location: home.php'); }

// ако формата е изпратена да се изпълни
if(isset($_POST['submit'])){

	// много проста форма на валидация
	if(strlen($_POST['username']) < 3){
		$error[] = 'Името е твърде късо.';
	} else {
		$stmt = $db->prepare('SELECT username FROM users WHERE username = :username');
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
		$error[] = 'Не е потвърдена паролата.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Въведените пароли не съвпадат.';
	}
	// валидиране на блоковете
	$adresi = $_POST['adresi'];
	$vhodove = $_POST['vhodove'];
	if(count($adresi)>0 && count($vhodove) == count($adresi)) {
	$errorsfromblocks = validateBlocks($_POST['adresi'],$_POST['vhodove'],$db);
	} else {
		$error[] = 'Не сте въвели входовете на които сте домоуправител.';
	}
	if(count($errorsfromblocks)>0) {
		$error[] = "Един или повече входове са заети.";
	}
	// e-mail валидиране
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Моля въведете валидна електронна поща';
	} else {
		$stmt = $db->prepare('SELECT email FROM users WHERE email = :email');
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
			$stmt = $db->prepare('INSERT INTO users (username,password,email,active,ime,familia,telefon) VALUES (:username, :password, :email, :active, :ime, :familia, :telefon)');
			$stmt->execute(array(
				':username' => $_POST['username'],
				':password' => $hashedpassword,
				':email' => $_POST['email'],
				':active' => $activasion,
				':ime' => $_POST['name'],
				':familia' => $_POST['familyname'],
				':telefon' => $_POST['phone'],
			));
			$id = $db->lastInsertId('idusers');
			//Създаване на блокове
			addBlocksToDatabase($adresi,$vhodove,$id,$db);
			
			// изпращане на електронна поща
			$to = $_POST['email'];
			$subject = "Nov domoupravitelski profil";
			$body = "<p>Napravena e nova registraciq za domoupravitel s ime : ." .$_POST['username']."</p>
			<p>Email: " .$_POST['email']."</p>
			<p>Za da potvurdite vashiqt profil kliknete vurhu linka: <a href='".DIR."/login/activate.php?x=$id&y=$activasion'>".DIR."/login/activate.php?x=$id&y=$activasion</a></p>
			<p>Regards Block-Fee-Management Team</p>";

			$mail = new Mail();
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->send();

			// редирект към логин страницата
			header('Location: /login.php?action=joined');
			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}
	}
}

?>
<script src="/login/inc/js/addInput.js" language="Javascript" type="text/javascript"></script>

<div class="container">
	<div class="row">
	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Нов профил за домоуправител</h2>
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
					echo "<h2 class='bg-success'>Регистрацията е успешна, моля проверете вашата електронна поща.</h2>";
				}
				?>

				<div class="form-group">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Потребителско име" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
					
				</div>
				<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="text" name="name" id="name" class="form-control input-lg" placeholder="Име" value="<?php if(isset($error)){ echo $_POST['name']; } ?>" tabindex="2">
							<span class="help-block">"Stefan"</span>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="text" name="familyname" id="familyname" class="form-control input-lg" placeholder="Фамилия" value="<?php if(isset($error)){ echo $_POST['familyname']; } ?>" tabindex="3">
							<span class="help-block">"Ivanov"</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Електронна поща" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="4">
					<span class="help-block">"stivanov@someemail.com"</span>
				</div>
				<div class="form-group">
					<input type="text" name="phone" id="phone" class="form-control input-lg" placeholder="Телефонен номер" value="<?php if(isset($error)){ echo $_POST['phone']; } ?>" tabindex="5">
					<span class="help-block">"0882293843" "+3591238523"</span>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" minlength="3" name="password" id="password" class="form-control input-lg" placeholder="Парола" tabindex="6">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" minlength="3" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Потвърди..." tabindex="7">
						</div>
					</div>
				</div>
				<div class="row">
				
				<div class="col-xs-10 col-md-10"><h3>Входове на които сте домоуправител:</h3></div>
				<div class="col-xs-2 col-md-2" style="margin-top:10"><input type="button" name="plus" value="+" class="btn btn-primary btn-block btn-lg" tabindex="17" onclick="addInput('dynamicInput')"></div>
				</div>
				<div id="dynamicInput">
				<div class="row">
				
					<div class="col-xs-9 col-sm-9 col-md-9">
						<div class="form-group">
							<input type="text" name="adresi[]" id="adresi[]" class="form-control input-lg" placeholder="Адрес" tabindex="7">
							<span class="help-block">"Vuzrajdane 32"</span>
						</div>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3">
						<div class="form-group">
							<input type="text" name="vhodove[]" id="vhodove[]" class="form-control input-lg" placeholder="Вход" tabindex="8">
							<span class="help-block">"3"</span>
						</div>
					</div>
					
				</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Регистрирай ме" class="btn btn-primary btn-block btn-lg" tabindex="18"></div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
function validateBlocks($adresi,$vhodove,$db) {
	$error = array();
	for($i = 0; $i < 4; $i++){
		if(isset($adresi[$i]) && isset($vhodove[$i])){
			$error = checkBlock($adresi[$i],$vhodove[$i],$db);
		}
	}
	return $error;
}
function checkBlock($adres,$vhod,$db) {
	try {
			$stmt = $db->prepare('SELECT * FROM vhodove WHERE adres = :adres AND vhod = :vhod ');
			$stmt->execute(array(
			':adres' => $adres,
			':vhod' => $vhod 
			)
			);

			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if(empty($row)){
				return;
			} else {
				$error[] = "Вход с адрес ".$row['adres']." ".$row['vhod']." вече има регистриран домоуправител.";
				return $error;
			}

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
}

function addBlocksToDatabase($adresi,$vhodove,$userid,$db) {
	$jivushti = 0;
	$apartamenti = 0;
	for($i = 0; $i<count($adresi); $i++) {
			if($adresi[$i]== "" || $vhodove[$i] == "") {
				continue;
			}
			$stmt = $db->prepare('INSERT INTO vhodove (adres,jivushti,apartamenti,idusers,vhod) VALUES (:adres, :jivushti, :apartamenti, :idusers, :vhod)');
			$stmt->execute(array(
				':adres' => $adresi[$i],
				':jivushti' => $jivushti,
				':apartamenti' => $apartamenti,
				':idusers' => $userid,
				':vhod' => $vhodove[$i]
			));
		
	}
}
?>
