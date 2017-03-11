<?php
 if(isset($_POST['zaglavie']) && isset($_POST['data'])) {
	 $zaglavie = $_POST['zaglavie'];
	 $saobshtenie = $_POST['saobshtenie'];
	 $vhod = $_POST['vhod'];
	 $data = $_POST['data'];
	 
	 $stmt = $db->prepare('INSERT INTO saobshtenia (zaglavie,saobshtenie,idvhodove,data) VALUES (:zaglavie, :saobshtenie, :idvhodove, :data)');
	$stmt->execute(array(
				':zaglavie' => $zaglavie,
				':saobshtenie' => $saobshtenie,
				':idvhodove' => $vhod,
				':data' => $data));
	 
	 
 }
?>


<div class="page-in">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 pull-left"><div class="page-in-name">Домоуправител: <span>Управление на съобщения</span></div></div>
    </div>
  </div>
</div>

<div>

<div class="container marg45">
 
    <div class="col-lg-12">
	<form class="form-style-9" method="post" action="messageman.php">
		<div class="promo-block">
        <div class="promo-text" style="margin-top:0px">Добавяне на съобщение</div>
        <div class="center-line" style="color:white;"></div>
      </div>
	
		 <div class="row">
		 <br>
		<ul>

			<li>
			<input type="text" name="zaglavie" class="field-style field-full align-none" placeholder="Заглавие" maxlength="35" />
			</li>
			<li>
			<textarea name="saobshtenie" class="field-style" placeholder="Съобщение"></textarea>
			</li>
			<li><label style="margin-left:210px; color:grey;">
				Крайна дата за съобщението:</label>
				<select class="field-style field-split align-left" name="vhod">
				<?php
							$stmt = $db->prepare('SELECT * FROM vhodove WHERE idusers = :idusers');
							$stmt->execute(array(':idusers' => $_SESSION['idusers']));
							while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
								echo "<option value=\"".$row['idvhodove']."\">".$row['adres']." ".$row['vhod']."</option>";
							}
							?>
				</select>
				<input type="date" min='1899-01-01' id="data" name="data" class="field-style field-split align-right"/>
			</li>
			<li>
			<input type="submit" value="Добави" />
			</li>
		</ul>
</form>
	</div>
  </div>
</div>


<div class="container marg45">
  <div class="row">
    <div class="col-lg-12">
      <div class="promo-block">
        <div class="promo-text">Съобщения</div>
        <div class="center-line" style="color:white;"></div>
      </div>
    </div>
    <div class="col-lg-12 marg25">
		<?php
		require("generatemessages.php");
		?>
	</div>
  </div>
</div>
	