

<?php

	if(isset($_POST['ime']) &&
	   isset($_POST['apart']) &&
	   isset($_POST['etaj']) &&
	   isset($_POST['jivushti'])
	   ){
		$ime = $_POST['ime'];
		$apart = $_POST['apart'];
		$etaj = $_POST['etaj'];
		$jivushti = $_POST['jivushti'];
		$jivotni = isset($_POST['jivotni']);
		$vhod = $_POST['vhod'];
		$komentar = $_POST['komentar'];
		
		$stmt = $db->prepare('INSERT INTO apartamenti (ime,etaj,apartament,jivushti,jivotni,komentar,uniqueid,idvhodove) VALUES (:ime, :etaj, :apartament, :jivushti, :jivotni, :komentar, :uniqueid, :idvhodove)');
			$stmt->execute(array(
				':ime' => $ime,
				':etaj' => $etaj,
				':apartament' => $apart,
				':jivushti' => $jivushti,
				':jivotni' => isjivotni($jivotni),
				':komentar' => $komentar,
				':uniqueid' => generateUniqueId($vhod,$etaj,$apart,$jivushti),
				':idvhodove' => $vhod
			));
		
		
		$stmt = $db->prepare('SELECT * FROM vhodove WHERE idvhodove = :idvhodove');
		$stmt->execute(array(':idvhodove' => $vhod));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$jiv = $row['jivushti'];
		$ap = $row['apartamenti'];
		
		$stmt = $db->prepare('UPDATE vhodove SET  jivushti = :jivushti WHERE idvhodove = :idvhodove');
		$stmt->execute(array(':jivushti' => ($jiv+$jivushti),
		':idvhodove' => $vhod));
		
		$stmt = $db->prepare('UPDATE vhodove SET  apartamenti = :apartamenti WHERE idvhodove = :idvhodove');
		$stmt->execute(array(':apartamenti' => (++$ap),
		':idvhodove' => $vhod));
		
	}
	
	function generateUniqueId($block,$floor,$apartment,$people) {
		$randomnumber = rand(65,91);

		$uniquenumber = $block + $floor + $apartment + $people + $randomnumber;

		$uniqueletter = chr(($uniquenumber % 26) + 65);

		$uniqueid = "B".$block."F".$floor."A".$apartment."".$uniqueletter.$uniquenumber;

		return $uniqueid;
}
	
	function isjivotni($jivotni){
		if($jivotni) 
		{
			return 1;
		}
		else
		{
			return 0;
		} 
	}


?>


<div class="page-in">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 pull-left"><div class="page-in-name">Домоуправител: <span>Управление на апартаменти</span></div></div>
    </div>
  </div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="container marg45">

	
	    
			<form class="form-style-9" role="form" method="post" action="" autocomplete="off">
				<div class="promo-block">
        <div class="promo-text">Добавяне на апартамент</div>
        <div class="center-line" style="color:white;"></div>
      </div><br>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				?>

				<div class="row">
				<div class = "col-xs-8 col-sm-8 col-md-8">
					<div class="form-group">
						<input type="text" name="ime" id="ime" class="form-control input-md" placeholder="Име" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
						<span class="help-block">"sem. Stefanovi"</span>
					</div>
				</div>
				<div class="col-xs-4 col-sm-4 col-md-4">
						<div class="form-group">
							<input type="text" name="apart" id="apart" class="form-control input-md" placeholder="Апартамент №" tabindex="2">
						</div>
					</div>
				</div>
				<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4">
						<div class="form-group">
							<input type="number"  min="0" step="1" name="etaj" id="etaj" class="form-control input-md" placeholder="Етаж" tabindex="3">
						</div>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4">
						<div class="form-group">
							<input type="number" min="0" step="1" name="jivushti" id="jivushti" class="form-control input-md" placeholder="Брой живущи"  tabindex="4">
						</div>
					</div>
				<div class="col-xs-4 col-sm-4 col-md-4">
					<div class="checkbox">
					<label><input type="checkbox" name="jivotni">Дом. Любимци?</label>
					</div>
					</div>
				</div>
					<label for="vhod">Вход:</label>
					<div class="form-group">
						 <select class="form-control" id="vhod" name="vhod">
							<?php
							$stmt = $db->prepare('SELECT * FROM vhodove WHERE idusers = :idusers');
							$stmt->execute(array(':idusers' => $_SESSION['idusers']));
							while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
								echo "<option value=\"".$row['idvhodove']."\">".$row['adres']." ".$row['vhod']."</option>";
							}
							?>
							
						</select>
					</div>
					<div class="form-group">
					<label for="comment">Коментар:</label>
						<textarea class="form-control" rows="5" id="komentar" name="komentar"></textarea>
					</div>
					
				
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Добави" class="btn btn-primary btn-block btn-lg" tabindex="18"></div>
				</div>
			</form>
		</div>
		
		
	
	
</div>
<div class="col-lg-12">
		<div class="container marg45">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xsm-12">
      <div class="promo-block">
        <div class="promo-text">Апартаменти</div>
        <div class="center-line" style="color:white;"></div>
		<br>
      </div>
	   
    </div>
   <?php require("aparttable.php");
	?>
  </div>
</div>
		</div>
</div>

