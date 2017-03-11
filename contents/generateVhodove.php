
<?php

$vhodove = getVhodove($_SESSION['idusers'],$db);
			
			for($i=0;$i<count($vhodove);$i++){
				$stmt = $db->prepare('SELECT * FROM vhodove WHERE idvhodove = :idvhodove');
				$stmt->execute(array(':idvhodove' => $vhodove[$i]));
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				echo "<div class=\"col-lg-6 well ".getVhodClass($i)."\">
				Адрес: <h5>".$row['adres']." ".$row['vhod']."</h5><hr>
	Брой апартаменти: ".$row['apartamenti']."    <span class=\"glyphicon glyphicon-home\"></span><hr>Брой живущи: ".$row['jivushti']."    <span class=\"glyphicon glyphicon-user\"></span><hr>Брой сметки :".getBroiSmetki($vhodove[$i],$db)."    <span class=\"glyphicon glyphicon-briefcase\"></span><hr>Брой съобщения :".getBroiSaobshtenia($vhodove[$i],$db)."    <span class=\"glyphicon glyphicon-envelope\"></span><hr>
	
	</div>";
			}

	function getBroiSmetki($vhod,$db){
		$stmt = $db->prepare('SELECT * FROM smetki WHERE idvhodove = :idvhodove');
				$stmt->execute(array(':idvhodove' => $vhod));
				return $stmt->rowCount();
	}	
	function getBroiSaobshtenia($vhod,$db){
		$stmt = $db->prepare('SELECT * FROM saobshtenia WHERE idvhodove = :idvhodove');
				$stmt->execute(array(':idvhodove' => $vhod));
				return $stmt->rowCount();
		
	}
	function getVhodClass($count){
		if($count==1 || $count==3) return "vhod-2";
		else return "vhod-1";
	}
?>