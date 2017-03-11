<html>
  <head>
    <title>Appartment Management</title>
    <style>
    table, th, td {
    border: 1px solid black;
}
    </style>
  </head>
  <body>
    <h1>Apartment Managment</h1>
    <h2>Add an appartment</h2>
    <form action="apartments.php" method="post">Name:
      <input type="text" name="name"></input>
      Block: <input type="text" maxlength="4" name="block" size="5"></input>
      Floor: <input type="text" maxlength="4" name="floor" size="5"></input>
      People: <input type="text" maxlength="4" name="people" size="5"></input>
      Apartment: <input type="text" maxlength="4" name="apartment" size="5"></input>
      Pets: <input type="checkbox" maxlength="4" name="pets" size="5"></input><br><br>
      Comment:<br> <textarea rows="4" cols="50" name="comment"></textarea><br>
      <input type="submit" value="Send Message"></input>
    </form>
    <h2>Apartments</h2>
    <table style="width:50%">
      <tr>
        <th width="200">Name</th>
        <th>Apartment</th>
        <th>Block</th>
        <th>Floor</th>
        <th>People</th>
        <th>Pets</th>
        <th width="400">Comment</th>
        <th>Unique ID</th>
      </tr>
      <?php
  			$conn = connectToServer();
        getApartmentsFromDatabase($conn);

        if(isset($_POST['name']) &&
         isset($_POST['block']) &&
          isset($_POST['floor']) &&
           isset($_POST['people']) &&
           isset($_POST['apartment'])) {
             $name = $_POST['name'];
             $block = $_POST['block'];
             $floor = $_POST['floor'];
             $people = $_POST['people'];
             $pets = $_POST['pets'];
             $comment = $_POST['comment'];
             $apartment = $_POST['apartment'];
             addApartment($name, $block, $floor,$apartment, $people, $pets,
             generateUniqueNumber($block,$floor,$apartment,$people),
            $comment,$conn);//59 trqq e apartament nomer trqq go dobavq gore
        }
    ?>
  </table><br>
</body>
</html>
<?php
function generateUniqueNumber($block,$floor,$apartment,$people) {
    $randomnumber = rand(65,91);
    $uniquenumber = $block + $floor + $apartment + $people + $randomnumber;
    $uniqueletter = chr(($uniquenumber % 26) + 65);
    $uniqueid = "B".$block."F".$floor."A".$apartment."".$uniqueletter.$uniquenumber;
    return $uniqueid;
}


function addApartment($name, $block, $floor, $apartment, $people, $pets, $uniqueid,$comment, $conn) {
  $sql = "INSERT INTO `apartments` (`idapartments`, `name`, `block`, `floor`, `apartment`, `people`, `pets`, `comment`, `uniqueid`) VALUES ('0', '".$name."', '".$block."', '".$floor."', '".$apartment."', '".$people."', '".$pets."', '".$comment."', '".$uniqueid."');";
  $result = mysqli_query($conn, $sql);
}

function getApartmentsFromDatabase($conn) {
  $sql = "SELECT * FROM `apartments` WHERE block = 12";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      echo"<tr><td>".$row["name"].
      "</td><td>".$row["block"].
      "</td><td>".$row["floor"].
      "</td><td>".$row["apartment"].
      "</td><td>".$row["people"].
      "</td><td>";
      if($row["pets"]==1)
        echo "YES";
      else
        echo "NO";
    echo "</td><td>".$row["comment"].
    "</td><td>".$row["uniqueid"].
    "</td></tr>";
    }
} else {
echo "0 results";
}
}

function connectToServer() {
     		//Localhost  za primerna baza ot danni
     		$servername = "localhost";
     		$username = "Dimitar";
     		$password = "123456";
     		$dbname = "blockfeemanagement";

			// Create connection
			$conn = mysqli_connect($servername, $username, $password, $dbname);

			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

     		return $conn;
     }

 ?>
