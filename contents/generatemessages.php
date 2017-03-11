<div class="row">
		
		<?php
		if (isset($_GET['id']))
				deleteMessage($_GET['id'],$db);
		
		
		
		$vhodove = getVhodove($_SESSION['idusers'],$db);
		$broqch = 0;
		for($i=0; $i<count($vhodove); $i++) {
			
			$stmt = $db->prepare('SELECT * FROM saobshtenia WHERE idvhodove = :idvhodove' );
			$stmt->execute(array(':idvhodove' => $vhodove[$i]));
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				if($broqch!=0 && $broqch%3==0){
					echo "</div><div class=\"row\">";
				}
				
				echo buildWell($row['zaglavie'],$row['saobshtenie'],$row['data'],getAdres($vhodove[$i],$db),$row['idsaobshtenia']);
			}
			
		}
		
		
		
		
		
		?>
		
		
		
		
		</div>
		
		
		
		
<?php
function deleteMessage($id, $db) {
	$stmt = $db->prepare('DELETE FROM `saobshtenia` WHERE idsaobshtenia = :id');
	$stmt->execute(array(':id' => $id));
}


 function getAdres($id, $db) {
	$stmt = $db->prepare('SELECT * FROM vhodove WHERE idvhodove = :idvhodove');
	$stmt->execute(array(':idvhodove' => $id));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row['adres'];
   }


	function buildWell($title,$message,$enddate,$vhod,$messageid) { 
		return "<div class=\"col-lg-4 col-md-6 col-sm-12 col-xsm-12\">
		
		<div class=\"well\">
		<div class=\"row\">
		<div class=\"col-lg-10 col-md-10 col-sm-9 col-xsm-9\" >
		<h5 style=\"text-align:center;font-size:15px;\">".$title."</h5>
		</div>
		<div class=\"col-lg-2 col-md-2 col-sm-2 col-xsm-2\" >
	<a href='messageman.php?id=".$messageid."' onclick=\"return confirm('Сигурни ли сте че искате да изтриете съобщението?')\"><h5 style=\"color:red;\"><span class=\"glyphicon glyphicon-remove\"></span></h5></a>
	</div>
		</div>
		<div class=\"row\">
		<hr style=\"border: 1px solid #00c0e1;\">
		</div>
		<div class=\"row\">
		<p style=\"text-align:center;\">
		".$message."
		<br>
		<br>
		</p>
		</div>
		<div class=\"row\">
		<div class=\"col-lg-6 col-md-6 col-sm-6 col-xsm-6\">
		<p style=\"font-size:13px\">
		".$vhod."
		</p>
		</div>
		<div class=\"col-lg-6 col-md-6 col-sm-6 col-xsm-6\">
		<p style=\"font-size:13px; text-align:right;\">
		Крайна Дата:<br> ".$enddate."
		</p>
		</div>
		
		
		
		</div>
			</div>
		</div>";
	}

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