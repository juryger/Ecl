<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="icon" href="/favicon.ico">-->

    <title>
        <?php echo $viewTitle; ?>
    </title>

    <!-- Bootstrap core CSS -->
    <link href="../public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../public/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="../public/css/dashboard.css" rel="stylesheet">
    <link href="../public/css/blog.css" rel="stylesheet">
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" style="margin-bottom: 0px;">
      <div class="container">
        <div class="navbar-header" style="float: none;">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div style="display: inline;">
            <a href="<?php echo BASE_URL; ?>public/index.php">
              <img src="../public/images/logo.jpg" height="60px" style="float: left;"/>
            </a>
            <a class="navbar-brand" style="font-size: 36px; margin-left: 1px;" href="<?php echo BASE_URL; ?>public/index.php">
              <span>Enthralling Carving</span>
            </a>
          </div>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><strike>Log in</strike></a></li>
            <li><a href="#"><strike>Join us</strike></a></li>
          </ul>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo BASE_URL; ?>public/home/index/intro">About Us</a></li> <!--class="active"-->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Study <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo BASE_URL; ?>public/article/index/tools">Carving basis</a></li>
                <li><a href="#"><strike>Hand-on Lessons</strike></a></li>
                <li role="separator" class="divider"></li>
                <!--<li class="dropdown-header">Nav header</li>-->
                <li><a href="<?php echo BASE_URL; ?>public/community/index/gallery"><strike>Gallery</strike></a></li>
              </ul>
            </li>
            <li><a href="<?php echo BASE_URL; ?>public/contest/index">Contests</a></li>
            <li><a href="<?php echo BASE_URL; ?>public/community/index/events/">Community</a></li>
            <li><a href="#"><strike>Help</strike></a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Begin page content -->
    <div class="container">
      <?php echo $viewContent; ?>
    </div>

    <footer class="footer" style="position: fixed;">
      <div class="container" style="text-align: center">
        <p class="text-muted">
          <a href="#"><strike>Privacy statement</strike></a>&nbsp;|&nbsp;
          &copy; 2016 Company, Inc.
        </p>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../public/js/ecl.js"></script>
    <script src="../public/js/jquery-3.1.0.min.js"></script>
    <script>window.jQuery</script>
    <script src="../public/js/bootstrap.min.js"></script>
  </body>
</html>
