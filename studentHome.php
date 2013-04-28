<?php
session_start();
/**
* Set-up session variables. 
*/
require ('config.php');
if (!isset($_SESSION['isloggedin']) || $_SESSION['usrtype'] != 'stud')
{
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">'; 
  die;
}
$_SESSION['isloggedin'] = true;
$_SESSION['usrtype'] = "stud";
?>

<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>ICSTS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="okay_files/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
    <link href="okay_files/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="images/favicon.ico">
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="jingi.php">ICSTS</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Logged in as <a href="userInfo.php" class="navbar-link"><?php echo $_SESSION['name'];?></a> <a style = "padding-left:50px;" href = "logout.php" class="navbar-link">logout</a>
            </p>
            <ul class="nav">
              <li class="active"><a href="studentHome.php">Home</a></li>
              <li><a href="about.php">About</a></li>
              <li><a href="contact.php">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="pagewrapper" style="margin-top:0px;padding:5px;padding-top:25px;">
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="image"><a href="#"><image src="images/logo2.png" height="200" width="250" alt="Image preview not available"></image></a></li>                
              <li class="active"><a>General Notifications </a></li>
              <?php 

                global $CFG;
                $dbhost = $CFG->dbhost;
                $dbuser = $CFG->dbuser;
                $dbname = $CFG->dbname;
                $dbpass = $CFG->dbpass;
                $dbprefix = $CFG->prefix;

                $con = mysql_connect($dbhost,$dbuser,$dbpass) or die (mysql_error());
                mysql_select_db($dbname,$con) or die (mysql_error()); 

                $query = "SELECT semester from ".$dbprefix."students WHERE USN='".$_SESSION['user']."'";
                $result = mysql_query($query,$con);
                while($row = mysql_fetch_array($result))
                {
                  $sem = $row['semester'];
                }
                $query = 'SELECT * FROM '.$dbprefix.'notifpr WHERE sem='.$sem;
                $result = mysql_query($query,$con);
                while($row = mysql_fetch_array($result))
                {
                  $notifhead = $row['notifh'];
                  $notifdesc = $row['notifd'];
                  $notiftm = $row['notiftm'];
                  $notiffile = $row['notiff'];
                
                    $data = '<!DOCTYPE html>
                    <html lang="en">
                    <head>
                      <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
                      <link href="images/favicon.ico" rel="icon" type="image/x-icon" />
                      <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
                      <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
                      <title>Welcome to Course Manager</title>
                      <link rel="stylesheet" type="text/css" href="../css/style.css">
                    <script type="text/javascript" src="../js/jquery.min.js"></script></head><body>

                  <div class="navbar navbar-inverse navbar-fixed-top">
                    <div class="navbar-inner">
                      <div class="container-fluid">
                        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                        </button>
                        <a class="brand" href="jingi.php">ICSTS</a>
                        <div class="nav-collapse collapse">
                          <p class="navbar-text pull-right">
                            Logged in as <a href="userInfo.php" class="navbar-link">'.$_SESSION['name'].'</a> <a style = "padding-left:50px;" href = "logout.php" class="navbar-link">logout</a>
                          </p>
                          <ul class="nav">
                            <li class="active"><a href="studentHome.php">Home</a></li>
                            <li><a href="about.php">About</a></li>
                            <li><a href="contact.php">Contact</a></li>
                          </ul>
                        </div><!--/.nav-collapse -->
                      </div>
                    </div>
                  </div><div class="pagewrapper" style= "padding-top:30px;padding-left:50px;margin-top:60px;">';
                  $data = $data.'<h1>'.$notifhead.'</h1>';
                  $data .= '<h4>'.$notifdesc.'</h4>';
                  $data .= '<a href='.$notiffile.'> Click here to download</a>';
                  $data .= '</div></body></html>';
                  $fname = 'notifications/notif_'.md5($notifhead.$notiftm).'.html';
                  
                  $f = fopen($fname,'w');
              
                  fwrite($f,$data);
                  fclose($f);
                  echo '<li><a href="'.$CFG->wwwroot.'/'.$fname.'">'.$notifhead.'</a></li>';
                }//end while loop
              ?><!--
              <li><a href="#">Link 1</a></li>
              <li><a href="#">Link 2</a></li>
              <li><a href="#">Link 3</a></li>-->
              <li class="active"><a>Test Notifications</a></li>
              <li><a href="#">Link 1</a></li>
              <li><a href="#">Link 2</a></li>
              <li><a href="#">Link 3</a></li>
              <li><a href="#">Link 4</a></li>
              <li><a href="#">Link 5</a></li>
              <li><a href="#">Link 6</a></li>
              <li class="active"><a>Placement notifications</a></li>
              <li><a href="#">Link 1</a></li>
              <li><a href="#">Link 2</a></li>
              <li><a href="#">Link 3</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->

        <div class="span9">
          <div class="hero-unit">
            <h1>The most important topic!</h1>
            <p>This area of the page is controlled by the admin and the admin alone</p>
            <p><a href="event.php" class="btn btn-primary btn-large">Learn more »</a></p>
          </div>
          <div class="row-fluid">
            <div class="span4">
              <h2>Marks</h2>
              <p>View your current marks till date and your current CGPA and SGPA</p>
              <p><a href="marks.php" class="btn" href="#">View marks »</a></p>
            </div><!--/span-->
            <div class="span4">
              <h2>Attendance</h2>
              <p>View your attendance in all the courses you've taken </p>
              <p><a href="geta.php"class="btn" href="#">View attendance »</a></p>
            </div><!--/span-->
            <div class="span4">
              <h2>Timetable</h2>
              <p>View the timetable as applicable to your class <br>in general </p>
              <p><a href="timetable.php"class="btn" href="#">View timetable »</a></p>
            </div><!--/span-->
          </div><!--/row-->
          </div><!--/row-->
 
      <hr>
    </div><!--/.fluid-container-->
  </div>
    <!-- javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="okay_files/jquery.js"></script>
    <script src="okay_files/bootstrap-transition.js"></script>
    <script src="okay_files/bootstrap-alert.js"></script>
    <script src="okay_files/bootstrap-modal.js"></script>
    <script src="okay_files/bootstrap-dropdown.js"></script>
    <script src="okay_files/bootstrap-scrollspy.js"></script>
    <script src="okay_files/bootstrap-tab.js"></script>
    <script src="okay_files/bootstrap-tooltip.js"></script>
    <script src="okay_files/bootstrap-popover.js"></script>
    <script src="okay_files/bootstrap-button.js"></script>
    <script src="okay_files/bootstrap-collapse.js"></script>
    <script src="okay_files/bootstrap-carousel.js"></script>
    <script src="okay_files/bootstrap-typeahead.js"></script>

  

</body></html>