



<!DOCTYPE html>

<html lang="en">



<head>



    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">



    <title>Message Board</title>

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

                <li>

                    <a href="apartments.php">Manage apartments</a>

                </li>

                <li>

                    <a href="fees.php">Manage fees</a>

                </li>

                <li class = "current">

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

                          require('config.php');

                          require_once('opendb.php');

                          require('dbfunctions.php');





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

