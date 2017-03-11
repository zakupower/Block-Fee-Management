	<?php

		if(isset($_POST['uniqueid'])) {

      $uniqueid = $_POST['uniqueid'];

     
	 
	$stmt = $db->prepare('SELECT * FROM apartamenti WHERE uniqueid = :uniqueid');
	$stmt->execute(array(':uniqueid' => $uniqueid));
	if($stmt->rowCount()!=0){
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		//
		$ime = $row['ime'];
		$etaj = $row['etaj'];
		$apartament = $row['apartament'];
		$jivushti = $row['jivushti'];
		$jivotni = $row['jivotni'];
		$idvhod = $row['idvhodove'];
		//
		
		$stmt = $db->prepare('SELECT * FROM vhodove WHERE idvhodove = :idvhodove');
		$stmt->execute(array(':idvhodove' => $idvhod));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		//
		$iduser = $row['idusers'];
		$adres = $row['adres'];
		$vhod = $row['vhod'];
		$apartamenti = $row['apartamenti'];
		$jivushtivhod = $row['jivushti'];
		//
		$stmt = $db->prepare('SELECT * FROM users WHERE idusers = :idusers');
		$stmt->execute(array(':idusers' => $iduser));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		//
		$imedomo = $row['ime'];
		$familiadomo= $row['familia'];
		$telefon = $row['telefon'];
		//
		$generateInfoFeesMessagesTrigger = true;
	} else {
		
		$error = "Не съществува апартамент с този уникален номер.";
	}
	
	

	
	
	
	
    }



	?>




<div class="page-in">

  <div class="container">

    <div class="row">

      <div class="col-lg-6 pull-left"><div class="page-in-name">Сметки <span> проверете сметките по апартамента си</span></div></div>

    </div>

  </div>

</div>

<div class="container marg75" style="margin-top:10px;">

  <div class="row">

    <div class="col-lg-12">

      <div class="promo-block">

        <div class="promo-text" style="margin-bottom:10px;">Въведете уникален код</div>

      </div>

    </div>

<div class="container-fluid" style="background-color:#00c0e1;padding-top:20px;">

<form action="checkfees.php" method="post">

  <div class="form-group">



<center>  <input class="form-control input-lg " name="uniqueid" maxlength="20" style="text-align:center; font-size:3em;width:50%;" type="text"></br>

<button type="submit" class="btn btn-primary">Провери сметки</button>

</center>

</div>

</form>
<?php
if(isset($error)){
	echo "<div class=\"alert alert-warning\">
   ".$error."
</div>";
} else {
	
}
?>
</div>

</div>

</div>

<div class="container marg75" style="margin-top:10px; padding-bottom:5px">

  <div class="row">

    <div class="col-lg-12">

      <div class="promo-block">

        <div class="promo-text">Информация за апартамента</div>

        <div class="center-line" style="color:white;"></div>

      </div>

    </div>

	<div class="col-lg-12">
		
  
	<?php
	if($generateInfoFeesMessagesTrigger == true) {
		echo "<div class=\"form-style-9\" style=\"text-align:left;font-size:20px;\">
			Име: ".$ime."<br>
			Адрес: ".$adres." вх. ".$vhod." етаж. ".$etaj." ап. ".$apartament."<br>
			Брой живущи: ".$jivushti."<br>
			Домашни любимци: ".getJivotno($jivotni)."<br>
		</div>

<div class=\"alert alert-info\" style=\"text-align:center;font-size:15px;\">
			<strong>За връзка с домоуправител</strong> 
			";
			echo "<br>".$imedomo." ".$familiadomo."<br>".$telefon."</div>";

	}
	
			
			
			function getJivotno($jivotno){
				if($jivotno==1){
					return "<span style=\"font-size:15px;\" class=\"glyphicon glyphicon-ok\"></span>";
				} else {
					return "<span style=\"font-size:15px;\" class=\"glyphicon glyphicon-remove\"></span>";
				}
			}
			
	?>
		


    </div>

  </div>

</div>

<div class="container marg45">

  <div class="row">

    <div class="col-lg-12 col-md-12 col-sm-12">

      <div class="promo-block"" style= "margin-bottom:15px;">

        <div class="promo-text">Сметки</div>

        <div class="center-line""></div>

      </div>

    <div class=tablesclass>

 <table id="tablica" class="table table-striped table-bordered" cellspacing="0" >
        <thead>
            <tr>
				
    <th>Име на сметката</th>

    <th>Дължима сума</th>

    <th>Вид на сметката</th>

    <th>Крайна дата за плащане</th>

    <th>Коментар</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
   <th>Име на сметката</th>

    <th>Дължима сума</th>

    <th>Вид на сметката</th>

    <th>Крайна дата за плащане</th>

    <th>Коментар</th>
            </tr>
        </tfoot>

    <tbody>


    <?php
	if($generateInfoFeesMessagesTrigger == true) {
		$stmt = $db->prepare('SELECT * FROM smetki WHERE idvhodove = :idvhodove');
		$stmt->execute(array(':idvhodove' => $idvhod));
				
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				if($row['vid']== 1 && $row['data'] < date("Y-m-d")) {
					;
				} else {
				generateSmetka($row['ime'],$row['suma'],$row['vid'],$row['nachin'],$row['data'],$row['izbrani'],$row['komentar'],$apartament,$etaj,$apartamenti,$jivushti,$jivotni,$jivushtivhod);	}
		}
	}
	function generateSmetka($ime,$suma,$vid,$nachin,$data,$izbrani,$komentar,$apartament,$etaj,$apartamenti,$jivushti,$jivotni,$jivushtivhod) {
		
		$realSuma = calculateSum($suma,$nachin,$izbrani,$apartament,$etaj,$apartamenti,$jivushti,$jivotni,$jivushtivhod);
		
		if($realSuma == "0лв.") {
			echo "";
		} else {
			echo "<tr>
			<td>".$ime."</td>
			<td>".$realSuma."</td>
			<td >".getVid($vid)."</td>
			<td >".getData($data,$vid)."</td>
			<td >".$komentar."</td>
			</tr>";
		}
	}
	function calculateSum($suma,$nachin,$izbrani,$apartament,$etaj,$apartamenti,$jivushti,$jivotni,$jivushtivhod){
		switch($nachin){
			case 1:
				//return "Всеки апартамент тази сума.";
				return $suma."лв.";
				break;
			case 2:
				//return "Всеки човек тази сума.";
				$x = $suma*$jivushti;
				return $x."лв.";
				break;
			case 3:
				//return "Всички апартаменти с домашни любимци.";
				if($jivotni==1){
					return $suma."лв.";
				} else {
					return "0лв.";
				}
				break;
			case 4:
				//return "Всички апартаменти освен етажи:";
				$izbraniEtaji = explode(",",$izbrani);
				for($i=0;$i<count($izbraniEtaji);$i++) {
					if($izbraniEtaji[$i]==$etaj) {
						return "0лв.";
					}
				}
				return $suma."лв.";
				break;
			case 5:
				//return "Всички апартаменти освен апартаменти:";
				$izbraniApartamenti = explode(",",$izbrani);
				for($i=0;$i<count($izbraniApartamenti);$i++) {
					if($izbraniApartamenti[$i]==$apartament) {
						return "0лв.";
					}
				return $suma."лв.";
				}
				break;
			case 6:
				//return "Само на апартаменти:";
				$izbraniApartamenti = explode(",",$izbrani);
				for($i=0;$i<count($izbraniApartamenti);$i++) {
					if($izbraniApartamenti[$i]==$apartament) {
						return $suma."лв.";
					}
				return "0лв.";
				}
				break;
			case 7:
				//return "Раздели на всеки апартамент тази сума.";
				return round($suma/$apartamenti,2)."лв.";
				break;
		}
	}
	
	
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
	
     ?>

    </tbody>

    </table>

    </div>

    <br>

  </div>

    <div class="col-lg-12 col-md-12 col-sm-12">

      <div class="promo-block">

        <div class="promo-text">Съобщения за входа</div>

        <div class="center-line"></div>

      </div>

      <div class="marg50">

        <div class="ac-container">

          <div>

          <?php
		  
		  
		  
			if($generateInfoFeesMessagesTrigger == true) {
				$stmt = $db->prepare('SELECT * FROM saobshtenia WHERE idvhodove = :idvhodove');
				$stmt->execute(array(':idvhodove' => $idvhod));
				$i = 0;
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo "<div>
				<input id=\"ac-".$i."\" name=\"accordion-2\" type=\"radio\" />
				<label for=\"ac-".$i."\">".$row['zaglavie']."</label>
				<article class=\"ac-small\">
				  <p style=\"color:white;\">".$row['saobshtenie']."</p>
				</article>
			  </div>";
				$i++;
				}
			}
         

           ?>



        </div>

      </div>

    </div>

  </div>

</div>

