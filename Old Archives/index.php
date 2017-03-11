<!DOCTYPE html>
<html lang="en" class="no-js">
  <head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title>Block Fee Management</title>
    <!--Description -->
    <meta content="Block Fee Management Description" name="description">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport"/>
    <!--ICON -->
    <link href="assets/images/favicon.ico" rel="shortcut icon"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/apple-touch-icon-144x144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/apple-touch-icon-114x114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/apple-touch-icon-72x72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="assets/images/apple-touch-icon-precomposed.png" />
    <!-- JS FILES -->
    <script type="text/javascript" src="assets/js/jquery-1.20.2.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="assets/js/modernizr.custom.js"></script>
    <!-- CSS FILES -->
    <link href="assets/css/style.css" media="screen" rel="stylesheet" type="text/css">
    <link href="assets/css/responsive.css" media="screen" rel="stylesheet" type="text/css">
    <link href="assets/rs-plugin/css/settings.css" media="screen" rel="stylesheet" type="text/css">
    <link href="assets/css/navstylechange.css" media="screen" rel="stylesheet" type="text/css">
    <link href="assets/css/testimonialrotator.css" media="screen" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="wrapper" style="background-color:#00c0e1">
      <?php require('includes/header.html') ?>
      <div class="page_head">
        <div class="nav-container" style="height: auto;">
          <nav>
            <div class="container">
              <div class="row">
                <!-- LOGO -->
                <div class="col-lg-3 col-sm-2 col-xsm-2 pull-left" style="margin-bottom:20px;"><div class="logo"><a href="index.php"><img src="assets/images/logo.png" alt=""></a></div></div>
                <!-- MENU -->
                <div class="col-lg-9 col-sm-10 col-xsm-10 pull-right">
                  <div class="menu">
                    <div id="dl-menu" class="dl-menuwrapper">
                    <button class="dl-trigger">Open Menu</button>
                      <ul class="dl-menu">
                        <li class="current"><a href="index.php">Home</a>
                        </li>
                        <li><a href="#">Login</a>
                        </li>
                        <li><a href="checkfees.php">Check Fees</a>
                        </li>
                        <li><a href="faq.php">FAQ</a>
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
      <?php require('includes/slideShow.html') ?>
      <?php require('includes/indexContent.html') ?>
      <?php require('includes/footer.html') ?>
      <script type="text/javascript">
        var revapi;
        jQuery(document).ready(function() {
             revapi = jQuery('.tp-banner').revolution({
              delay:9000,
              startwidth:1170,
              startheight:500,
              hideThumbs:10,
              forceFullWidth:"off",
            });
        }); //ready
      </script>
    </div>
    <script type="text/javascript" src="assets/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
    <script type="text/javascript" src="assets/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="assets/js/waypoints.min.js"></script>
    <script type="text/javascript" src="assets/js/sticky.js"></script>
    <script type="text/javascript" src="assets/js/jquery.tweet.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.flexslider-min.js"></script>
    <script type="text/javascript" src="assets/js/testimonialrotator.js"></script>
    <script type="text/javascript" src="assets/js/jquery.cycle.all.js"></script>
    <script type="text/javascript" src="assets/js/jcarousel.responsive.js"></script>
    <script type="text/javascript" src="assets/js/jquery.jcarousel.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.dlmenu.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
  </body>
</html>
