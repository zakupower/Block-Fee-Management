<!DOCTYPE html>
<?php require_once('login/inc/config.php'); ?>
<html lang="en" class="no-js">

  <head>
	
	<meta charset="utf-8">

    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->

    <title>Block Fee Management Check Fees</title>

    <!--Description -->

    <meta content="Block Fee Management Description" name="description">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport"/>

     <?php
	require("cssjsicons.html");
	?>
	<link href="assets/css/form.css" media="screen" rel="stylesheet" type="text/css">
    <link href="assets/css/tables.css" rel="stylesheet" type="text/css">

  </head>

  <body>

    <div id="wrapper" style="background-color:#00c0e1;">

      <?php require('contents/header.html'); ?>

      <div class="page_head">

        <div class="nav-container" style="height: auto;">

          <nav>

            <div class="container">

              <div class="row">

                <!-- LOGO -->

                <div class="col-lg-3 pull-left"><div class="logo"><a href="index.php"><img src="assets/images/logo.png" alt=""></a></div></div>

                <!-- MENU -->

                <div class="col-lg-9 pull-right">

                  <div class="menu">

                    <div id="dl-menu" class="dl-menuwrapper">

                    <button class="dl-trigger"></button>

                      <ul class="dl-menu">

                        <li><a href="index.php">BlockM</a>

                        </li>

                        
						<?php
						if( !($user->is_logged_in()) ){ 
							echo "<li><a href=\"login.php\">Вход</a>

                        </li>";
						} 
						if( $user->is_logged_in() ){ 
							echo "<li><a href=\"home.php\">Домоуправител</a>\n                          <ul class=\"dl-submenu\"><li><a href=\"home.php\">Домоуправител</a></li>\n                            <li><a href=\"apartmentman.php\">Управление на апартаменти</a></li>\n                            <li><a href=\"feeman.php\">Управление на сметки</a></li>\n                            <li><a href=\"messageman.php\">Управление на съобщения</a></li>\n                          <li><a href=\"/login/logout.php\">Изход</a></li></ul>\n                        </li>";
						} 
						?>
						
                        <li class="current"><a href="checkfees.php">Проверка на сметки</a>

                        </li>

                        <li><a href="faq.php">Помощ</a>

                        </li>

                      </ul>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </nav>

        </div>

      </div>

      <?php require('contents/checkFeesContent.php'); ?>



    </div>

    <?php require('contents/footer.html'); ?>

    <script type="text/javascript" src="assets/js/waypoints.min.js"></script>

    <script type="text/javascript" src="assets/js/sticky.js"></script>

    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="assets/js/jquery.tweet.min.js"></script>

    <script type="text/javascript" src="assets/js/jquery.flexslider-min.js"></script>

    <script type="text/javascript" src="assets/js/retina.js"></script>

    <script type="text/javascript" src="assets/js/jquery.dlmenu.js"></script>

    <script type="text/javascript" src="assets/js/main.js"></script>

  </body>

</html>

