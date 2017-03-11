<?php
// включване на конфиг файла
require_once('inc/config.php');

// проверка дали е сте логнат и да го прехвърли на друга страница
if( $user->is_logged_in() ){ header('Location: /home.php'); } 

// ако формата е изпратена да се изпълни
if(isset($_POST['submit'])){

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if($user->login($username,$password)){ 
		$_SESSION['username'] = $username;
		header('Location: /home.php');
		exit;
	
	} else {
		$error[] = 'Грешно име/парола или не сте одобрен от администратора.';
	}

}// край на събмит формата


// включване нa хийдъра
// require('inc/header.php'); 
?>
<div class="page-in">

  <div class="container">

    <div class="row">

      <div class="col-lg-6 pull-left"><div class="page-in-name">Вход <span> за домоуправители</span></div></div>

    </div>

  </div>

</div>
	
<div class="container">
	<div class="row">
	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3" style="padding: 20px;">
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Вход в системата </h2>
				
			
		
				<?php
				// проверка за грешки
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}
				if(isset($_GET['action'])){

					// проверка още :D
					switch ($_GET['action']) {
						case 'active':
							echo "<h3 class='bg-success'>Вашият профил е активиран.</h3>";
							break;
						case 'reset':
							echo "<h3 class='bg-success'>Проверете вашата електронната поща за линк за смяна на паролата.</h3>";
							break;
						case 'resetAccount':
							echo "<h3 class='bg-success'>Паролата ви е сменена.</h3>";
							break;
						case 'joined':
							echo"<h3 class='bg-success'>Проверете вашата електронна поща за линк за активиране на профила.</h3>";
							break;
						case 'deleted':
							echo"<h3 class='bg-success'>Успешно изтрихте вашият профил.</h3>";
						break;
					}

				}
				?>
				<div class="form-group">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Потребителско име" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
				</div>

				<div class="form-group">
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Парола" tabindex="3">
				</div>
				
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						 <a href='/registration.php'>Регистрация</a>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						 <a href='/resetpage.php'>Забравена парола</a>
					</div>
				</div>	
				<br>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Вход" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>
			</form>
		</div>
	</div>
</div>


