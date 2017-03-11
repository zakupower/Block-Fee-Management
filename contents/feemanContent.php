
<div class="page-in">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 pull-left"><div class="page-in-name">Домоуправител: <span>Управление на сметки</span></div></div>
    </div>
  </div>
</div>
<div class="container marg45">
	<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xsm-12">
	<div class="form-style-9">
	<div class="alert alert-warning">
  <strong>Внимание!</strong> При въвеждането на апартаменти/етажи трябва да разделяте апартаментите/етажите със запетаи: "1,12,3,3B"
</div>
	<div class="alert alert-info">
  <strong>Вид на сметката</strong> <br>
	<ul>
	<li>
	<div style="color:#00c0e1; display: inline">При еднократна сметка</div> се задава датата ,до която трябва да се плати. След минаване на датата сметката се изтрива автоматично.
	</li>
	<li>
	<div style="color:#00c0e1; display: inline">При месечна сметка</div> значение има само деня от месеца, другата част от датата се игнорира.
	</li>
	<li>
	<div style="color:#00c0e1; display: inline">Годишната сметка</div> се води за всяка година на датата ,която сте избрали като крайна.
	</li>
	</ul>
	</div>
	<div class="alert alert-info">
  <strong>Начини за плащане</strong> 

	<br>
	<ul>
	<li>
	<div style="color:#00c0e1; display: inline">Всеки апартамент тази сума.</div> На всеки апартамент от входа се начислява въведената сума.
	</li>
	<li>
	<div style="color:#00c0e1; display: inline">Всеки човек тази сума.</div> На всеки апартамент от входа се начислява въведената сума на човек.
	</li>
	<li>
	<div style="color:#00c0e1; display: inline">Всички апартаменти освен етаж:</div> На всички апартаменти освен посочените етажи.
	</li>
	<li>
	<div style="color:#00c0e1; display: inline">Всички апартаменти освен апартаменти:</div> На всички апартаменти освен посочените.
	</li>
	<li>
	<div style="color:#00c0e1; display: inline">Само на апартаменти:</div> Само на посочените апартаменти
	</li>
	</ul>
	</div>
	
	</div>
  </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xsm-12">
	<form class="form-style-9" method="post" action="feeman.php">
		<div class="promo-block">
        <div class="promo-text" style="margin-top:0px">Добавяне на сметка</div>
        <div class="center-line" style="color:white;"></div>
      </div>
	  <?php
	if(isset($_POST['ime']) &&
			 isset($_POST['suma']) &&
			 isset($_POST['data'])) {
				 $ime = $_POST['ime'];
				 $vid = $_POST['vid'];
				 $nachin = $_POST['nachin'];
				 $izbrani = $_POST['izbrani'];
				 $suma = $_POST['suma'];
				 $komentar = $_POST['komentar'];
				  $data = $_POST['data'];
				  $vhod = $_POST['vhod'];
				  $preg = preg_match("/(\d+[a-zA-Z])|(\d+)|([a-zA-Z]\d+)*,/",$izbrani);
				  if($preg || $izbrani=="") {
					  $stmt = $db->prepare('INSERT INTO smetki (ime,suma,vid,nachin,data,izbrani,komentar,idvhodove) VALUES (:ime, :suma, :vid, :nachin, :data, :izbrani, :komentar, :idvhodove)');
					$stmt->execute(array(
						':ime' => $ime,
						':suma' => $suma,
						':vid' => $vid,
						':nachin' => $nachin,
						':data' => $data,
						':izbrani' => $izbrani,
						':komentar' => $komentar,
						':idvhodove' => $vhod
						));
					  
				  } else {
					echo "<div class=\"alert alert-danger\">
  <strong>Внимание!</strong> При въвеждането на апартаменти/етажи трябва да разделяте апартаментите/етажите със запетаи: \"1,12,3,3B\"
</div>	";
				  }
			  }
			 
?>
		
		 <div class="row">
		 <br>
		<ul>

			<li>
			<input type="text" name="ime" class="field-style field-full align-none" placeholder="Име" maxlength="35" />
			</li>
			<li>
			
			<div class="row" style="bottom-padding:10px;">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xsm-6">
				<label style="margin-left:10px; color:grey;">
				Вид сметка: 
				</label>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xsm-6">
				<label style="color:grey;">
				Начин за начисляване:
				</label>
				</div>
				</div>
				
			<select class="field-style field-split align-left" name="vid">
			<option value="1">Еднократна</option>
			<option value="2">Месечна</option>
			<option value="3">Годишна</option>
			</select>
			<select class="field-style field-split align-right" name="nachin" onchange="yesnoCheck(this);">
			<option value="1">Всеки апартамент тази сума.</option>
			<option value="7">Раздели на всеки апартамент тази сума.</option>
			<option value="2">Всеки човек тази сума.</option>
			<option value="3">Всички апартаменти с домашни любимци.</option>
			<option value="4">Всички апартаменти освен етажи:</option>
			<option value="5">Всички апартаменти освен апартаменти:</option>
			<option value="6">Само на апартаменти:</option>
			</select>
			</li>
			<li>
			<input type="text" name="izbrani" class="field-style field-split align-right" placeholder="2,15,23,13" id="ifYes" style="display: none;" />
			
			<input type="number" step="0.01" name="suma" class="field-style field-split align-left" placeholder="Сума" />
			</li>
			<li>
			<textarea name="komentar" class="field-style" placeholder="Коментар"></textarea>
			</li>
			<li><label style="margin-left:210px; color:grey;">
				Крайна дата за плащане:</label>
				<select class="field-style field-split align-left" name="vhod">
				<?php
							$stmt = $db->prepare('SELECT * FROM vhodove WHERE idusers = :idusers');
							$stmt->execute(array(':idusers' => $_SESSION['idusers']));
							while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
								echo "<option value=\"".$row['idvhodove']."\">".$row['adres']." ".$row['vhod']."</option>";
							}
							?>
				</select>
				<input type="date" name="data" class="field-style field-split align-right"/>
			</li>
			<li>
			<input type="submit" value="Добави" />
			</li>
		</ul>
</form>
	</div>
  </div>
  
  
  
  </div>
</div>

<div class="container marg45">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xsm-12">
      <div class="promo-block">
        <div class="promo-text">Сметки</div>
        <div class="center-line" style="color:white;"></div>
		<br>
      </div>
	   
    </div>
   <?php require("feetable.php");
	?>
  </div>
</div>
<script type="text/javascript">
    function yesnoCheck(that) {
        if (that.value == 4 || that.value == 5 || that.value == 6) {
            document.getElementById("ifYes").style.display = "block";
        } else {
            document.getElementById("ifYes").style.display = "none";
        }
    }
</script>