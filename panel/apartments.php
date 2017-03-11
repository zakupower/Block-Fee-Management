

<!DOCTYPE html>

<html lang="en">



<head>



    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">



    <title>Appartment Management</title>

    <style>

    table, th, td {

    border: 1px solid black;

}

    </style>



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

                <li class="current">

                    <a href="apartments.php">Manage apartments</a>

                </li>

                <li>

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

                      <h1>Apartment Managment</h1>

                      <h2>Add an appartment</h2>

                      <form action="apartments.php" method="post">Name:

                        <input type="text" name="name"></input>

                        Block: <input type="text" maxlength="4" name="block" size="5"></input>

                        Floor: <input type="text" maxlength="4" name="floor" size="5"></input>

                        People: <input type="text" maxlength="4" name="people" size="5"></input>

                        Apartment: <input type="text" maxlength="4" name="apartment" size="5"></input>

                        Pets: <input type="checkbox" maxlength="4" name="pets" size="5"></input><br><br>

                        Comment:<br> <textarea rows="4" cols="50" name="comment"></textarea><br><br>

                        <input type="submit" value="Add apartment"></input>

                      </form>

                      <h2>Apartments</h2>

                      <table style="width:75%">

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

                        require('config.php');

                        require_once('opendb.php');

                        require('dbfunctions.php');





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

