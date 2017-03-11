<?php 
	if(isset($_POST['telefon'])){
		$stmt = $db->prepare('UPDATE users SET telefon = :telefon WHERE idusers = :idusers');
		$stmt->execute(array(':telefon'=> $_POST['telefon'],
							':idusers' => $_SESSION['idusers']));
	}
	if(isset($_POST['email'])) {
		
		$stmt = $db->prepare('UPDATE users SET email = :email WHERE idusers = :idusers');
		$stmt->execute(array(':email'=> $_POST['email'],
							':idusers' => $_SESSION['idusers']));
		
	}
	if(isset($_POST['password']) && isset($_POST['confirm'])) {
		if($_POST['password'] == $_POST['confirm']) {
			$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);
			$stmt = $db->prepare('UPDATE users SET password = :password WHERE idusers = :idusers');
			$stmt->execute(array(':password'=> $hashedpassword,
							':idusers' => $_SESSION['idusers']));
			} else {
				$error="Паролите не съвпадът.";
			}
			$user->logout();
			header('Location: login.php?action=resetAccount');
							
	}
	if(isset($_GET['deleteid']) && $_GET['deleteid']==$_SESSION["idusers"]) {
		
		$vhodove = getVhodove($_SESSION['idusers'],$db);
			
			for($i=0;$i<count($vhodove);$i++){
				$stmt = $db->prepare('DELETE FROM `apartamenti` WHERE idvhodove = :id');
				$stmt->execute(array(':id' => $vhodove[$i]));
			}
			for($i=0;$i<count($vhodove);$i++){
				$stmt = $db->prepare('DELETE FROM `smetki` WHERE idvhodove = :id');
				$stmt->execute(array(':id' => $vhodove[$i]));
			}
			for($i=0;$i<count($vhodove);$i++){
				$stmt = $db->prepare('DELETE FROM `saobshtenia` WHERE idvhodove = :id');
				$stmt->execute(array(':id' => $vhodove[$i]));
			}
			
		$stmt = $db->prepare('DELETE FROM `vhodove` WHERE idusers = :id');
		$stmt->execute(array(':id' => $_GET['deleteid']));
		
		$stmt = $db->prepare('DELETE FROM `users` WHERE idusers = :id');
		$stmt->execute(array(':id' => $_GET['deleteid']));
		$user->logout();
		header('Location: login.php?action=deleted');
		exit;
	}
	

 ?>
  
 
<style type="text/css">
hr {
	margin-top:15px;
	margin-bottom:15px;
	
}
span.info {
	font-size:17px;
	font-family: Times New Roman, Georgia, serif;
}
.vhod-1 {
	padding:10px; 
	background-color: #0ad8fc;
}
.vhod-2 {
	padding:10px; 
	background-color:#66e8ff;
}
</style>
<div class="page-in">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 pull-left"><div class="page-in-name">Домоуправител: <span>Информация</span></div></div>
    </div>
  </div>
</div>
<br>
<br>
<div class="container marg45">
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-12 col-xsm-12">
<div class="form-style-9">
	<?php
	if($error) {
	echo '<div class="alert alert-warning">
  <strong>Грешка!</strong> ';

	
	echo $error;
	
	echo"</div>";
	}
	?>
  <div class="row">
    <div class="col-lg-12">
      <div class="promo-block">
        <div class="promo-text">Домоуправител</div>
        <div class="center-line"></div>
      </div>
    </div>
    <div class="col-lg-12">
	<br>
	<center>
			<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xsm-6">
			<h5>Име:</h5>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xsm-6" >
			<span class="info" style="font-family: 'Times New Roman';!important">
			<?php
					$stmt = $db->prepare('SELECT * FROM users WHERE idusers = :idusers');
					$stmt->execute(array(':idusers' => $_SESSION['idusers']));
					$row = $stmt->fetch(PDO::FETCH_ASSOC);
					echo $row['ime']." ".$row['familia'];
			?>
			</span> 
			</div>
			</div>
  <hr>
  <div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xsm-12">
  <h5>Телефон:</h5>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xsm-6">
  <span class="info">
  <?php
	echo $row['telefon'];
	
  ?>
  </span>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xsm-6">
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#telefon">Смени телефон</button>
  </div>
  </div>
  
  <hr>
  
    <div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xsm-12">
 <h5>Електронна поща:</h5>
  </div>
   <div class="col-lg-6 col-md-6 col-sm-6 col-xsm-6">
  <span class="info">
  <?php
  echo $row['email'];
  ?>
  </span>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xsm-6">
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#email">Смени ел.поща</button>
  </div>
 
  </div>

  <hr>
			  <div class="row">
  <div class="col-lg-4 col-md-4 col-sm-4 col-xsm-4">
 <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#password" style="margin-left:20px">Смени парола</button>
  </div>
   <div class="col-lg-4 col-md-4 col-sm-4 col-xsm-4">
  <?php
 echo "<a href=\"home.php?deleteid=".$_SESSION['idusers']."\" onclick=\"return confirm('Сигурни ли сте че искате да изтриете домоуправителският си профил? Това ще изтрие и всички входове,апартаменти,сметки и съобщения към този профил.')\">
  <button type=\"button\" class=\"btn btn-danger btn-sm\" style=\"margin-left:20px\">Изтриване профил</button></a>"
  ?>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xsm-4">

	<a href="/login/logout.php">
  <button type="button" class="btn btn-warning btn-sm" style="margin-left:20px">Изход</button></a>
  </div>
 
  </div>					
								
								<br>
								</center>
	</div>
  </div>

</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xsm-12">
<div class="form-style-9">

  <div class="row">
    <div class="col-lg-12">
      <div class="promo-block">
        <div class="promo-text">Входове</div>
        <div class="center-line"></div>
      </div>
	  <br>

    </div>
	<?php
		require('generateVhodove.php');
	?>
    
	
  </div>

</div>
</div>
	
</div>
</div>

<!-- Modal -->
  <div class="modal fade" id="telefon" role="dialog" style="margin-top:400px;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
	  <form method="post" action="home.php">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Смяна на телефонен номер</h4>
        </div>
        <div class="modal-body" style="background-color:#66e8ff;">
         
		 <input class="input-sm" type="text" placeholder="Нов телефонен номер" name="telefon"></input>
		 
        </div>
        <div class="modal-footer">
		  <button type="submit" class="btn btn-default">Смени</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Затвори</button>
        </div>
		</form>
      </div>
	</div>
  </div>
  
  
  
  <!-- Modal -->
  <div class="modal fade" id="email" role="dialog" style="margin-top:400px;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
	  <form method="post" action="home.php">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Смяна на електронна поща</h4>
        </div>
        <div class="modal-body" style="background-color:#66e8ff;">
         
		 <input class="input-sm" type="text" placeholder="Нова електронна поща" name="email"></input>
		 
        </div>
        <div class="modal-footer">
		  <button type="submit" class="btn btn-default">Смени</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Затвори</button>
        </div>
		</form>
      </div>
	</div>
  </div>
  
  <!-- Modal -->
  <div class="modal fade" id="password" role="dialog" style="margin-top:400px;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
	  <form method="post" action="home.php">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Смяна на парола</h4>
        </div>
        <div class="modal-body" style="background-color:#66e8ff;">
		 <input class="input-sm" type="password" minlength="3" placeholder="Нова парола" name="password"></input>
		  <input class="input-sm" type="password" minlength="3" placeholder="Потвърди..." name="confirm"></input>
        </div>
        <div class="modal-footer">
		  <button type="submit" class="btn btn-default">Смени</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Затвори</button>
        </div>
		</form>
      </div>
	</div>
  </div>
  <?php
  function getVhodove($id, $db) {
	$stmt = $db->prepare('SELECT * FROM vhodove WHERE idusers = :idusers');
	$stmt->execute(array(':idusers' => $id));
	$vhodove = array();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$vhodove[] = $row['idvhodove'];
	}
	return $vhodove;
   }
  ?>
  