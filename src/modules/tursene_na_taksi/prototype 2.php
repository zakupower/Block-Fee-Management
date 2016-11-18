

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Block Fee Management</title>
  <meta name="description" content="Searching for taxes using uniqueId">
  <meta name="author" content="Dimitar Tomov">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/custom_styles.css">
  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>
<body style="background-color: #1372FF">
  <!-- Begin page content -->
     <div class="container" style="background-color: #1372FF; width: 1500px;">
       <div class="page-header jumbotron" style= "padding:5px">
         <h1 class="text-center">Проверка на сметки </h1>
       </div>
        <div class="row">
        <div class="jumbotron col-lg-12" id="jumbo">
          </br>
          <div class = "jumbotron text-center" style="background-color:#FF6400; padding: 0px;padding-bottom:10px; margin: 0px;">
            <h2 style="padding: 0px; margin: 0px;">Unique ID:</h2></br>
              <form  method="post" name="myform" action="prototype 2.php">
                  <input id="uni" type="text" name="mytext" maxlength="80" size="30"></input>
                  <input type="submit" value="Submit" ></input>
              </form>
            </div>
          </br>
        <h3 class="text-center">Съобщения от домуоправителя</h3>
        <p style="background-color:#FF7939; padding: 10px;">
          До всички живущи на 06.06.06 ще призоваваме сатаната във входа от 06.06.06 часа. Присъствието е задължително на поне един от живущите пригответе си агне за жертва.
        </p>
       <p id="Name" style="background-color:#FF9664; padding: 10px;">

       </p>
       <table class = "table table-bordered table-striped">
          <caption>Сметки</caption>
   <thead>
      <tr style="background-color:#FF6400">
         <th>Вид сметка</th>
         <th>Дължима сума</th>
         <th>Статус</th>
         <th>Коментар</th>
      </tr>
   </thead>

   <tbody>
      <tr style="background-color:#FF7939">
         <td>Асансьор</td>
         <td></td>
         <td></td>
         <td></td>
      </tr>

      <tr style="background-color:#FF9664">
         <td>Домашен любимец</td>
         <td></td>
         <td></td>
         <td></td>
      </tr>

      <tr style="background-color:#FF7939">
         <td>Чистачка</td>
         <td></td>
         <td></td>
         <td></td>
      </tr>
      <tr style="background-color:#FF9664">
         <td>Електричество</td>
         <td></td>
         <td></td>
         <td></td>
      </tr>
      <tr style="background-color:#FF7939">
         <td>Вход</td>
         <td></td>
         <td></td>
         <td></td>
      </tr>
      <tr style="background-color:#FF9664">
         <td>Допълнителни</td>
         <td></td>
         <td></td>
         <td></td>
      </tr>
   </tbody>

        </table>
      </div>
       </div>
     </div>

     <footer class="footer">
       <div class="container-fluid">
         <div class = "row">
           <div class = "jumbotron container-fluid col-lg-6 col-md-6 col-sm-6 col-xs-12" style="background-color: #FF6400; padding: 5px;">
              sed. Mauris nec facilisis felis. Nulla pretium metus vitae nisi luctus, vitae pulvinar erat bibendum. Morbi cursus, ipsum vitae blandit pulvinar, metus tellus tempor mauris, sed elementum justo tortor in elit. Sed convallis erat a orci hendrerit condimentum. Donec gravida
              sed. Mauris nec facilisis felis. Nulla pretium metus vitae nisi luctus, vitae pulvinar erat bibendum. Morbi cursus, ipsum vitae blandit pulvinar, metus tellus tempor mauris, sed elementum justo tortor in elit. Sed convallis erat a orci hendrerit condimentum. Donec gravida
              sed. Mauris nec facilisis felis. Nulla pretium metus vitae nisi luctus, vitae pulvinar erat bibendum. Morbi cursus, ipsum vitae blandit pulvinar, metus tellus tempor mauris, sed elementum justo tortor in elit. Sed convallis erat a orci hendrerit condimentum. Donec gravida

           </div>
           <div class = "jumbotron container-fluid col-lg-6 col-md-6 col-sm-6 col-xs-12 float-left"style="background-color: #FFD300; padding: 5px;">
             sed. Mauris nec facilisis felis. Nulla pretium metus vitae nisi luctus, vitae pulvinar erat bibendum. Morbi cursus, ipsum vitae blandit pulvinar, metus tellus tempor mauris, sed elementum justo tortor in elit. Sed convallis erat a orci hendrerit condimentum. Donec gravida
             sed. Mauris nec facilisis felis. Nulla pretium metus vitae nisi luctus, vitae pulvinar erat bibendum. Morbi cursus, ipsum vitae blandit pulvinar, metus tellus tempor mauris, sed elementum justo tortor in elit. Sed convallis erat a orci hendrerit condimentum. Donec gravida
             sed. Mauris nec facilisis felis. Nulla pretium metus vitae nisi luctus, vitae pulvinar erat bibendum. Morbi cursus, ipsum vitae blandit pulvinar, metus tellus tempor mauris, sed elementum justo tortor in elit. Sed convallis erat a orci hendrerit condimentum. Donec gravida

           </div>
         </div>
       </div>
     </footer>






     <?php
       $conn = connectToServer();

       if(isset($_POST["mytext"])) {

         $id = $_POST["mytext"];

         if(is_numeric($id)) {
           $row = searchInDatabase($id,$conn);

           if(is_numeric($row["floor"])) {
             $pass = createSummary($row["name"],$row["floor"],$row["people"]);
           }
           else {
             $pass = "Не е открит в базата ни от данни.";
           }
         }
         else {
           $pass = "Трябва да е число!";
         }
       }


       function searchInDatabase($uniqueId,$conn) {
         $sql = "SELECT * FROM `Apartment` WHERE `UniqueId` = $uniqueId";
         $result = mysqli_query($conn, $sql);
         $row = mysqli_fetch_assoc($result);
         return $row;
       }

       function connectToServer() {
         //Localhost  za primerna baza ot danni
         $servername = "192.168.0.102";
         $username = "Dimitar";
         $password = "123456";
         $dbname = "blockfeemanagement";
         // Create connection
         $conn = new mysqli($servername, $username, $password,$dbname);

         if (!$conn) {
           die("Connection failed: " . mysqli_connect_error());
         }
         return $conn;
     }
       function createSummary($name,$floor,$people) {
         return "Име:" . $name. "</br>" . "Етаж:" . $floor . "</br>Хора в апартамента:" . $people . "</br>";
       }

     ?>

<script type="text/javascript">
//display information from sql
document.getElementById('Name').innerHTML = "<?php echo $pass;?>";

</script>




</body>
</html>
