<html>
  <head>
    <title>Message Board</title>
    <style>
    table, th, td {
    border: 1px solid black;
}
    </style>
  </head>
  <body>
    <h1>Message Board</h1>
    <h2>Add a Message</h2>
    <form action="messages.php" method="post">Title: <br>
      <input type="text" name="title"></input><br>Message: <br>
      <textarea rows="4" cols="50" name="message"></textarea><br><br>
      End date: <input type="date" name="enddate"></input>
      Block: <input type="text" maxlength="4" name="block"></input><br><br>
      <input type="submit" value="Send Message"></input>
    </form>
    <h2>Active Messages</h2>
    <table style="width:50%">
      <tr>
        <th>Title</th>
        <th>Message</th>
        <th>Block</th>
        <th width="100">End date</th>
        <th>Delete</th>
      </tr>
      <?php
  			$conn = connectToServer();
        getMessagesFromDatabase($conn);

        if(isset($_POST['title']) &&
         isset($_POST['message']) &&
          isset($_POST['block']) &&
           isset($_POST['enddate'])) {
             $title = $_POST['title'];
             $message = $_POST['message'];
             $block = $_POST['block'];
             $enddate = $_POST['enddate'];
             sendMessage($title,$message,$block,$enddate,$conn);

        }
    ?>
  </table><br>
</body>



</html>
<?php
function sendMessage($title,$message,$block,$enddate,$conn) {
    $sql = "  INSERT INTO `messages` (`idmessages`, `title`, `message`, `idvhodove`, `enddate`) VALUES ('3', '".$title."', '".$message."', '".$block."', '".$enddate."')";
    $result = mysqli_query($conn, $sql);
}

function getMessagesFromDatabase($conn) {
  $sql = "SELECT * FROM `messages` WHERE enddate >= CURDATE()";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      echo"<tr><td>".$row["title"].
      "</td><td>".$row["message"].
      "</td><td>".$row["idvhodove"].
      "</td><td>".$row["enddate"].
      "</td>
      <td><input type=\"checkbox\" name=\"".$row["title"]."\"></input></td>
      </tr>";
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
