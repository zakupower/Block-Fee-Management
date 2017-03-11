<?php

function generatemessages($uniqueid,$conn) {

  $number = 0;

  $sql = "SELECT * FROM `messages` WHERE idblocks LIKE '".getuniqueblockid($uniqueid,$conn)."' and enddate >= CURDATE()";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {

      echo "<div>

        <input id=\"ac-".$number."\" name=\"accordion-2\" type=\"radio\" />

        <label for=\"ac-".$number."\">".$row['title']."</label>

        <article class=\"ac-large\">

          <p style=\"color:white;\">".$row['message']."</p>

        </article>

      </div>";

      $number++;

    }

  } else {

  return null;

}

}





function generatefees($uniqueid,$conn) {

  $sql = "SELECT * FROM `fees` WHERE idblocks LIKE '".getuniqueblockid($uniqueid,$conn)."'";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {

      echo "<tr>

      <td>".$row['name']."</td>

      <td>".getexactfee($row['fee'],$row['way'],$uniqueid,$conn)."</td>

      <td>".$row['type']."</td>

      <td>".$row['duedate']."</td>

      <td>".$row['comment']."</td>

      </tr>";

    }

} else {

return null;

}

}

function getexactfee($fee,$way,$uniqueid,$conn) {

  switch($way) {

    case 0:

      return $fee;

      break;

    case 1:

      return $fee * getpeopleinapart($uniqueid,$conn);

      break;

    case 2:

      return round($fee / getapartmentsinblock($uniqueid,$conn),2);

      break;

    case 3:

      return 0;

      break;

    case 4:

      return 0;

      break;

    case 5:

      return 0;

      break;

    case 6:

      return 0;

      break;

    default:



  }

}



function getpeopleinapart($uniqueid,$conn) {

  $sql = "SELECT * FROM `apartments` WHERE uniqueid LIKE '".$uniqueid."'";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {

      return $row['people'];

    }

} else {

return null;

}

}



function getapartmentsinblock($uniqueid,$conn) {

  $sql = "SELECT * FROM `blocks` WHERE idblocks LIKE '".getuniqueblockid($uniqueid,$conn)."'";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {

      return $row['apartments'];

    }

} else {

return null;

}

}





function getuniqueblockid($uniqueid,$conn) {

  $sql = "SELECT * FROM `apartments` WHERE uniqueid LIKE '".$uniqueid."'";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {

      return $row['idblocks'];

    }

} else {

return null;

}

}





function generateapartinfo($uniqueid, $conn) {

  $sql = "SELECT * FROM `apartments` WHERE uniqueid LIKE '".$uniqueid."'";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {

      echo "Name: ".$row['name']."<br>";

      echo "Address: ".getaddress($row['idblocks'],$conn)." fl  ".$row['floor']." ap ".$row['apartment']."<br>";

      echo "People: ".$row['people'];

      echo " Pets: ";

      if($row['pets']==1)

        echo "YES<br>";

      else

        echo "NO<br>";

      echo "Block Keeper:<br>";

      echo generateblockkeeperinfo($row['idblocks'],$conn);

      return $row['idblocks'];

    }

} else {

return null;

}

}



function generateblockkeeperinfo($blockid,$conn) {

  $sql = "SELECT * FROM `blockkeepers` WHERE idblockkeepers LIKE '".getblockkeeperid($blockid,$conn)."'";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {

      echo "Name: ".$row['name']."<br>";

      echo "Email: ".$row['email']."<br>";

      echo "Phone number: ".$row['phone']."";

    }

} else {

return null;

}

}



function getblockkeeperid($blockid,$conn) {

  $sql = "SELECT * FROM `blocks` WHERE idblocks LIKE '".$blockid."'";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {

      return $row['idblockkeepers'];

    }

} else {

return null;

}

}



function getaddress($blockid,$conn) {

  $sql = "SELECT * FROM `blocks` WHERE idblocks LIKE '".$blockid."'";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {

      return $row['address'];

    }

} else {

return null;

}

}





function getapartid($uniqueid,$conn) {

  $sql = "SELECT idapartments FROM `apartments` WHERE uniqueid LIKE '".$uniqueid."'";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {

      return $row['idapartments'];

    }

} else {

return null;

}

}


function checkUniqueId($uniqueid,$conn) {

	$sql = "SELECT * FROM `apartments` WHERE 'uniqueid' LIKE '$uniqueid'";

	$result = $conn->query($sql);

	return $result!=null;

}





function generateUniqueNumber($block,$floor,$apartment,$people) {

    $randomnumber = rand(65,91);

    $uniquenumber = $block + $floor + $apartment + $people + $randomnumber;

    $uniqueletter = chr(($uniquenumber % 26) + 65);

    $uniqueid = "B".$block."F".$floor."A".$apartment."".$uniqueletter.$uniquenumber;

    return $uniqueid;

}



function addApartment($name, $block, $floor, $apartment, $people, $pets, $uniqueid,$comment, $conn) {

  $sql = "INSERT INTO `apartments` (`idapartments`, `name`, `block`, `floor`, `apartment`, `people`, `pets`, `comment`, `uniqueid`) VALUES (3, '".$name."', '".$block."', '".$floor."', '".$apartment."', '".$people."', '".$pets."', '".$comment."', '".$uniqueid."');";

  $result = mysqli_query($conn, $sql);

  updateBlockInfo($block,$people,$conn);

}



function updateBlockInfo($block, $people, $conn) {

  $people += getpeople($block,$conn);

  $apartments = 1 + getapartments($block, $conn);

  $sql = "UPDATE blocks SET people = ".$people." WHERE block=".$block."";



  if (mysqli_query($conn, $sql)) {

  } else {

  }

  $sql = "UPDATE blocks SET apartments = ".$apartments." WHERE block=".$block."";

  if (mysqli_query($conn, $sql)) {

  } else {

  }

}



function getapartments($block,$conn) {

    $sql = "SELECT * FROM `blocks` WHERE block = ".$block."";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

      // output data of each row

      while($row = mysqli_fetch_assoc($result)) {

        return $row['apartments'];

      }

  } else {

  return null;

  }

}



function getpeople($block,$conn) {

    $sql = "SELECT * FROM `blocks` WHERE block = ".$block."";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

      // output data of each row

      while($row = mysqli_fetch_assoc($result)) {

        return $row['people'];

      }

  } else {

  return null;

  }

}



function getApartmentsFromDatabase($conn) {

  $sql = "SELECT * FROM `apartments` WHERE idblocks = 0";//sesiqta

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {

      echo"<tr><td>".$row["name"].

      "</td><td>".$row["apartment"].

      "</td><td>".$row["block"].

      "</td><td>".$row["floor"].

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



function addFee($name, $block, $fee, $duedate, $type, $way, $selectedapartments, $comment, $conn) {

  //  $sql = "  INSERT INTO `fees` (`idfees`, `name`, `idblocks`, `fee`, `duedate`, 'type', 'way', 'selectedapartments','comment') VALUES ('0', '".$name."', '".getblockid($block,$conn)."', '".$fee."', '".$duedate."', '".$type."', '".$way."', '".$selectedapartments."', '".$comment."')";

    $sql = "INSERT INTO `fees` (`idfees`, `name`, `idblocks`, `fee`, `duedate`, `type`, `way`, `selectedapartments`, `comment`) VALUES ('0', '".$name."', '".getblockid($block,$conn)."', '".$fee."', '".$duedate."', '".$type."', '".$way."', '".$selectedapartments."', '".$comment."')";

    $result = mysqli_query($conn, $sql);

}



function getblockid($block, $conn) {

  $sql = "SELECT * FROM `blocks` WHERE block = ".$block."";//session variable

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {

      return $row['idblocks'];

    }

} else {

return null;

}

}



function getFeesFromDatabase($conn) {

  $sql = "SELECT * FROM `fees` WHERE idblocks = 0";//session variable

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {

      echo"<tr><td>".$row["name"].

      "</td><td> ".getblock($row["idblocks"],$conn).

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



function sendMessage($title,$message,$block,$enddate,$conn) {

    $sql = "  INSERT INTO `messages` (`idmessages`, `title`, `message`, `idblocks`, `enddate`) VALUES ('3', '".$title."', '".$message."', '".getblockid($block, $conn)."', '".$enddate."')";

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

      "</td><td>".getblock($row["idblocks"],$conn).

      "</td><td>".$row["enddate"].

      "</td>

      <td><input type=\"checkbox\" name=\"".$row["title"]."\"></input></td>

      </tr>";

    }

} else {

echo "0 results";

}

}



function getblock($blockid,$conn) {

  $sql = "SELECT * FROM `blocks` WHERE idblocks = ".$blockid."";//session variable

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    // output data of each row

    while($row = mysqli_fetch_assoc($result)) {

      return $row['block'];

    }

} else {

return null;

}



}



 ?>

