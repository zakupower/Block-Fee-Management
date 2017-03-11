

<!DOCTYPE html>

<html lang="en">



<head>

  <style>

    table, th, td {

    border: 1px solid black;

      }

  </style>



    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">



    <title>Block Fee Management</title>



    <!-- Bootstrap Core CSS -->

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <link href="simple-sidebar.css" rel="stylesheet">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->



</head>



<body>



    <div id="wrapper">



        <!-- Sidebar -->

        <div id="sidebar-wrapper">

            <ul class="sidebar-nav">

                <li class="sidebar-brand">

                    <a href="index.php">

                        Block Management Panel

                    </a>

                </li>

                <li>

                    <a href="apartments.php">Manage apartments</a>

                </li>

                <li class = "current">

                    <a href="fees.php">Manage fees</a>

                </li>

                <li>

                    <a href="messages.php">Manage messages</a>

                </li>
<li>

                    <a href="/login/logout.php">Exit</a>

                </li>
            </ul>

        </div>

        <!-- /#sidebar-wrapper -->



        <!-- Page Content -->

        <div id="page-content-wrapper">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-12">

                      <h1>Fee Management</h1>

                      <h2>Add a fee</h2>

                      <form action="fees.php" method="post">Name:

                        <input type="text" name="name"></input>

                        Block: <input type="text" maxlength="4" name="block" size="5"></input>

                        Fee: <input type="text" name="fee" size="5"></input>

                        Due date: <input type="date" name="date" size="5"></input><br><br>

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

                        Comment :<br> <textarea rows="4" cols="50" name="comment"></textarea><br>

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

                          <th width="100">Fee</th>

                          <th width="200">Due Date</th>

                          <th width="400">Comment</th>

                        </tr>

                        <?php

                        require('config.php');

                        require_once('opendb.php');

                        require('dbfunctions.php');



                          getFeesFromDatabase($conn);

                          if(isset($_POST['name']) &&

                             isset($_POST['block']) &&

                             isset($_POST['fee']) &&

                             isset($_POST['date'])

                        ){

                          $name = $_POST['name'];

                          $block = $_POST['block'];

                          $fee = $_POST['fee'];

                          $date = $_POST['date'];

                          $type = $_POST['type'];

                          $way = $_POST['way'];

                          $selectedapartments = $_POST['selectedapartments'];

                          $comment = $_POST['comment'];

                          addFee($name,$block,$fee,$date,$type,$way,$selectedapartments, $comment, $conn);

                          } else {



                          }

                          mysqli_close($conn);

                      ?>

                    </table><br>



                    </div>

                </div>

            </div>

        </div>

        <!-- /#page-content-wrapper -->



    </div>

    <!-- /#wrapper -->



    <!-- jQuery -->

    <script src="js/jquery.js"></script>



    <!-- Bootstrap Core JavaScript -->

    <script src="js/bootstrap.min.js"></script>



    <!-- Menu Toggle Script -->

    <script>

    $("#menu-toggle").click(function(e) {

        e.preventDefault();

        $("#wrapper").toggleClass("toggled");

    });

    </script>



</body>



</html>

