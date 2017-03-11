
<script type="text/javascript">$(document).ready(function() {
    $('#tablica').DataTable();
} );</script>

<table id="tablica" class="table table-striped table-bordered" cellspacing="0" >
        <thead>
            <tr>
				<th>Вход</th>
                <th>Име</th>
                <th>Сума</th>
                <th>Вид</th>
                <th>Начин на начисляване</th>
                <th>Избрани апартаменти/етажи</th>
                <th>Крайна дата за плащане</th>
				<th>Коментар</th>
				<th>Изтриване</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
				<th>Име</th>
                <th>Вход</th>
                <th>Сума</th>
                <th>Вид</th>
                <th>Начин на начисляване</th>
                <th>Избрани апартаменти/етажи</th>
                <th>Крайна дата за плащане</th>
				<th>Коментар</th>
				<th>Изтриване</th>
            </tr>
        </tfoot>
        <tbody>
		   <?php
		   
			if (isset($_GET['id']))
				deleteSmetka($_GET['id'],$db);
			
			$vhodove = getVhodove($_SESSION['idusers'],$db);
			
			for($i=0;$i<count($vhodove);$i++){
				$stmt = $db->prepare('SELECT * FROM smetki WHERE idvhodove = :idvhodove');
				$stmt->execute(array(':idvhodove' => $vhodove[$i]));
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo "<tr>
					<td>".$row['ime']."</td>
					<td>";
					echo getAdres($row['idvhodove'],$db);
					echo "</td>
					<td>".$row['suma']."лв.</td>
					<td>".getVid($row['vid'])."</td>
					<td>".getNachin($row['nachin'])."</td>
					<td>".$row['izbrani']."</td>
					<td>".getData($row['data'],$row['vid'])."</td>
					<td>".$row['komentar']."</td>
					<td><a href=\"feeman.php?id=".$row['idsmetki']."\" onclick=\"return confirm('Сигурни ли сте че искате да изтриете сметката?')\"><h4 style=\"color:red;\"><span class=\"glyphicon glyphicon-remove\"></span></h4></a></td>
				</tr>";
				}
			}
				  
		   ?>

        </tbody>
    </table>
<?php
	function getData($data,$vid) {
		if($vid==2)
			return date('Y')."-".date('m')."-".substr($data,-2,2);
		else
			return $data;
	}
	function getVid($vid){
		switch($vid){
			case 1:
				return "Еднократна";
				break;
			case 2:
				return "Месечна";
				break;
			case 3:
				return "Годишна";
				break;
		}
	}
	function getNachin($nachin) {
		switch($nachin){
			case 1:
				return "Всеки апартамент тази сума.";
				break;
			case 2:
				return "Всеки човек тази сума.";
				break;
			case 3:
				return "Всички апартаменти с домашни любимци.";
				break;
			case 4:
				return "Всички апартаменти освен етажи:";
				break;
			case 5:
				return "Всички апартаменти освен апартаменти:";
				break;
			case 6:
				return "Само на апартаменти:";
				break;
			case 7:
				return "Раздели на всеки апартамент тази сума.";
				break;
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
   function deleteSmetka($id, $db) {
	   
	$stmt = $db->prepare('DELETE FROM `smetki` WHERE idsmetki = :id');
	$stmt->execute(array(':id' => $id));
	
   }
?>