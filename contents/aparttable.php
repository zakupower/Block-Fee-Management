<script type="text/javascript">$(document).ready(function() {
    $('#tablica').DataTable();
} );</script>

<table id="tablica" class="table table-striped table-bordered" cellspacing="0" >
        <thead>
            <tr>
                <th>Име</th>
                <th>Адрес</th>
                <th>Апартамент</th>
                <th>Етаж</th>
                <th>Брой живущи</th>
                <th>Дом. любимци</th>
				<th>Уникален Номер</th>
				<th>Коментар</th>
				<th>Изтриване</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Име</th>
                <th>Адрес</th>
                <th>Апартамент</th>
                <th>Етаж</th>
                <th>Брой живущи</th>
                <th>Дом. любимци</th>
				<th>Уникален Номер</th>
				<th>Коментар</th>
				<th>Изтриване</th>
            </tr>
        </tfoot>
        <tbody>
		   <?php
		   
			if (isset($_GET['id']))
				deleteApartment($_GET['id'],$db);
			
			$vhodove = getVhodove($_SESSION['idusers'],$db);
			
			for($i=0;$i<count($vhodove);$i++){
				$stmt = $db->prepare('SELECT * FROM apartamenti WHERE idvhodove = :idvhodove');
				$stmt->execute(array(':idvhodove' => $vhodove[$i]));
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo "<tr>
					<td>".$row['ime']."</td>
					<td>";
					echo getAdres($row['idvhodove'],$db);
					echo "</td>
					<td>".$row['apartament']."</td>
					<td>".$row['etaj']."</td>
					<td>".$row['jivushti']."</td>
					<td>".getJivotno($row['jivotni'])."</td>
					<td>".$row['uniqueid']."</td>
					<td>".$row['komentar']."</td>
					<td><a href=\"apartmentman.php?id=".$row['uniqueid']."\" onclick=\"return confirm('Сигурни ли сте че искате да изтриете апартамента?')\"><h4 style=\"color:red;\"><span class=\"glyphicon glyphicon-remove\"></span></h4></a></td>
				</tr>";
				}
			}
				  
		   ?>

        </tbody>
    </table>
<?php
	function getJivotno($jivotni){
			  if($jivotni==1){
				  return "<span class=\"glyphicon glyphicon-ok\"></span>";
			  } else {
				  return "<span class=\"glyphicon glyphicon-remove\"></span>";
			  }
		  }
   function getAdres($id, $db) {
	$stmt = $db->prepare('SELECT * FROM vhodove WHERE idvhodove = :idvhodove');
	$stmt->execute(array(':idvhodove' => $id));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row['adres'];
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
   function deleteApartment($uniqueid, $db) {
	$stmt = $db->prepare('SELECT * FROM apartamenti WHERE uniqueid = :id');
	$stmt->execute(array(':id' => $uniqueid));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$vhod = $row['idvhodove'];
	$jivushti = $row['jivushti'];
	
	$stmt = $db->prepare('DELETE FROM `apartamenti` WHERE uniqueid = :id');
	$stmt->execute(array(':id' => $uniqueid));
	
	$stmt = $db->prepare('SELECT * FROM vhodove WHERE idvhodove = :id');
	$stmt->execute(array(':id' => $vhod));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$jiv = $row['jivushti'] - $jivushti;
	$ap = $row['apartamenti'];
	
	$stmt = $db->prepare('UPDATE vhodove SET jivushti= :jivushti WHERE idvhodove = :id');
	$stmt->execute(array(':id' => $vhod,
						':jivushti' =>$jiv));
	$stmt = $db->prepare('UPDATE vhodove SET apartamenti= :apartamenti WHERE idvhodove = :id');
	$stmt->execute(array(':id' => $vhod,
						':apartamenti' =>--$ap));
	
   }
?>
	
	