<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Searching for apartment</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
Unique ID:
<form  method="post" name="myform" action="phpDatabase.php">
    <input id="uni" type="text" name="mytext" maxlength="80" size="30">
    <input type="submit" value="Submit" >
</form>
<p id="Name">

</p>
<?php

$conn = connectToServer();

if (isset($_POST["mytext"])) {
  $id = $_POST["mytext"];

  if(is_numeric($id)) {
    $row = searchInDatabase($id,$conn);
    if(is_numeric($row["floor"])) {
      $pass = "Your name is " . $row["name"] . " you live on the " . $row["floor"] . " floor. You are " . $row["people"] . " people there. And you owe me " . $row["payment"] . "$ .";
    }
    else {
      $pass = "No such person.";
    }
    }

  else {
    $pass = "Has to be a number!";
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

 ?>

<script type="text/javascript">
//display information from sql
document.getElementById('Name').innerHTML = "<?php echo $pass;?>";

</script>


</body>
</html>
