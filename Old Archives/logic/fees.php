<html>
  <head>
    <title>Fee Management</title>
    <style>
    table, th, td {
    border: 1px solid black;
}
    </style>
  </head>
  <body>
    <h1>Fee Management</h1>
    <h2>Add a fee</h2>
    <form action="messages.php" method="post">Name:
      <input type="text" name="name"></input>
      Block: <input type="text" maxlength="4" name="block" size="5"></input>
      Fee: <input type="text" name="fee" size="5"></input>
      Due date: <input type="text" name="date" size="5"></input><br><br>
      Type:
      <select name="type">
    <option value="0">One time fee</option>
    <option value="1">Monthly fee</option>
    <option value="2">Yearly fee</option>
    </select>
    <select name="way">
  <option value="0">All apartments per apartment this sum</option>
  <option value="1">All apartments per person this sum</option>
  <option value="2">All apartments per apartment split this sum</option>
    <option value="3">All apartments with pets</option>
      <option value="4">All apartments except floor:</option>
        <option value="5">All apartments except apartment:</option>
          <option value="6">Only to this apartment:</option>
  </select>
  <input type="text" name="selectedapartments"></input><br><br>
      Comment :<br> <textarea rows="4" cols="50" name="message"></textarea><br>
      <br><input type="submit" value="Add fee"></input>
    </form>
    <h2>Fees</h2>
    <table style="width:75%">
      <tr>
        <th width="200">Name</th>
        <th>Block</th>
        <th>Type</th>
        <th width="200">Pricing</th>
        <th>Apartments</th>
        <th>Fee</th>
        <th width="200">Due Date</th>
        <th width="400">Comment</th>
      </tr>
      <?php
  			$conn = connectToServer();
        getFeesFromDatabase($conn);

    ?>
  </table><br>
</body>
</html>
<?php
function gettypefee($num){
  switch ($num) {
    case 0:
        return "one time";
        break;
    case 1:
        return "monthly";
        break;
    case 2:
        return "yearly";
        break;
    default:
        return "error";
}
}
function getwayfee($num){
  switch ($num) {
    case 0:
        return "All apartments per apartment this sum";
        break;
    case 1:
        return "All apartments per person this sum";
        break;
    case 2:
        return "All apartments per apartment split this sum";
        break;
    case 3:
        return "All apartments with pets";
        break;
    case 4:
        return "All apartments except floor:";
        break;
    case 5:
        return "All apartments except apartment:";
        break;
    case 6:
        return "Only to this apartment:";
        break;
    default:
        return "error";
}
}

function addApartment($name, $block, $floor, $people, $pets, $conn) {
    $sql = "  INSERT INTO `apartments` (`idapartments`, `name`, `block`, `floor`, `people`, 'pets','comment') VALUES ('0', '".$title."', '".$message."', '".$block."', '".$enddate."')";
    $result = mysqli_query($conn, $sql);
}

function getFeesFromDatabase($conn) {
  $sql = "SELECT * FROM `fees` WHERE idblock = 0";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      echo"<tr><td>".$row["name"].
      "</td><td>".$row["idblock"].
      "</td><td>".gettypefee($row['type']).
      "</td><td>".getwayfee($row['way']).
      "</td><td>".$row["selectedapartments"].
      "</td><td>".$row["fee"].
      "</td><td>".$row["duedate"].
      "</td><td>".$row["comment"].
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
