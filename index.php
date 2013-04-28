<?php
session_start();
$_SESSION['isvalins'] = false;
$iswrongpass = false;
/**
* Check whether configuation file exists.If it doesn't
* redirect for installa
*/
if (!file_exists('./config.php')) {
	$_SESSION['isvalins'] = true;
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=getdata.php">'; 
    die;
}
require './config.php';
if ($_SESSION['isloggedin'] == true)
{
	if($_SESSION['usrtype'] == "stud")
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=studentHome.php">';
	
	else if ($_SESSION['usrtype'] == "fac")
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facultyHome.php">';

	else if($_SESSION['usrtype'] == "adm")
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=adminHome.php">';
 
	die;
}
if(isset($_SESSION['wrongpass']) && $_SESSION['wrongpass'] == true)
{
	$iswrongpass = true;
	$wrongmsg = "Wrong username/password";
	unset($_SESSION['wrongpass']);
}
else
{
	$iswrongpass = false;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link href='images/favicon.ico' rel='icon' type='image/x-icon' />
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<title>Welcome to Course Manager</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">

function valid() {
	/**  
	* Function to validate usernamr based on type of user
	*/
	if($("#loginstud").attr('checked') == 'checked')
	{	
		$("#submit").removeAttr('disabled');
		$('#status_stop').html('');
    	var check = new RegExp("[0-9][a-z][a-z][0-9][0-9][a-z][a-z][0-4][0-9][0-9]", "g");
        var text = $("#username").val();
        var match = check.exec(text);

        if (match == null)
        {
            $('#status_stop').html('INVALID USN');
        	$("#submit").attr('disabled','disabled');
        }
        else if (match[0] === text)
        {
        	$('#status_stop').html('');
        	$("#submit").removeAttr('disabled');	
        }
	}
	else if($("#loginfac").attr('checked') == 'checked')
	{	
		$("#submit").removeAttr('disabled');
		$('#status_stop').html('');
    	var check = new RegExp("[0-9][0-9][0-9[0-9][0-9][0-9]", "g");
        var text = $("#username").val();
        var match = check.exec(text);

        if (match == null)
        {
            $('#status_stop').html('INVALID Faculty ID');
        	$("#submit").attr('disabled','disabled');
        }
        else if (match[0] === text)
        {
        	$('#status_stop').html('');
        	$("#submit").removeAttr('disabled');	
        }
	}

	else if($("#loginadm").attr('checked') == 'checked')
	{	

		$("#submit").removeAttr('disabled');
		$('#status_stop').html('');
		var check = new RegExp("[0-9]","g");
        var text = $("#username").val();
        var match = check.exec(text);

        if (match == null)
        {
            $('#status_stop').html('INVALID Admin ID');
        	$("#submit").attr('disabled','disabled');
        }
        else if (match[0] === text)
        {
        	$('#status_stop').html('');
        	$("#submit").removeAttr('disabled');	
        }
	}
 };

function valpass()
{
	/**
	* Function to check if password has been input
	*/	
	$('#status_stop').html('');	
	$("#submit").removeAttr('disabled');

	if($("#password").val() == '')
	{
		$('#status_stop').html('Password cannot be empty');	
		$("#submit").attr('disabled','disabled');
	}
	else
	{
		$('#status_stop').html('');	
		$("#submit").removeAttr('disabled');
	}
};
$(function () {

	    $("#username").blur(valid);
	    $("#password").blur(valpass);
});
</script>
</head>

<body onload="init()">

  <!-- nav bar -->
  <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="nav-collapse collapse" style="margin-left:150px">
            <ul class="nav">
              <li class="active"><a href="jingi.php"><strong>ICSTS</strong></a></li>
              <li class="active"><a href="index.php" style="margin-left:100px"><strong>Home</strong></a></li>
              <li class="active"><a href="about.php" style="margin-left:100px"><strong>About</strong></a></li>
              <li class="active"><a href="contact.php" style="margin-left:100px"><strong>Contact</strong></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  <!--  <div class="container">-->  
  	<div class="pageheader" style = "height:35px; margin-top:40px; padding-top:20px;">
		<div style="text-align:center;">
		<font style = "font-family: verdana; font-size:40px; font-weight:bold; color:#003300;">Welcome to ISCTS</font>
		</div>
		
	</div>
<div class="pagewrapper">
	<div class="userlogin" style = "font-family:Times new roman;">
		<h2 align="center" style="color:#333385;"> Login </h2>
		<br/>
		<form action="./loginauth.php" method="post">
			<table>

				<tr><td class="loginfo">Username</td><td><input type="text" name="username" id="username" placeholder="Username"/></td></tr>
				<tr><td class="loginfo">Password</td><td><input type="password" name ="password" id="password" placeholder="Password"/></td></tr>
				<tr><td class="radbut"><input type="radio" name="logintype" id ="loginstud" value="student" checked> </td><td class="radinfo">Student</td></tr>
				<tr><td class="radbut"><input type="radio" name="logintype" id ="loginfac" value="faculty"></td><td class="radinfo"> Faculty </td></tr>
				<tr><td class="radbut"><input type="radio" name="logintype" id ="loginadm" value="admin"></td><td class="radinfo"> Admin </td></tr>
			</table>
			<br/>
				<p  class="warning" id="status_stop"><?php 
				if ($iswrongpass == true)
				{
					echo $wrongmsg;
				}
			?></p>

					<input id="submit" type= "submit" value="LOGIN" class="btn btn-large btn-block btn-info"/>
				
		</form>
		<a class="forgot" href="./forgot.php">Forgot Password ?</a>
	</div>
    <div class="notifdisp">    
    <h2 align="center" style="color:#773737;">Notifications</h2>
	<marquee direction="up" height="400px" behaviour="alternate" onmouseover="this.stop()" onmouseout="this.start()">
	<div class="notifcontainer">
    <?php
    	global $CFG;
		$dbhost = $CFG->dbhost;
		$dbuser = $CFG->dbuser;
		$dbname = $CFG->dbname;
		$dbpass = $CFG->dbpass;
		$dbprefix = $CFG->prefix;

		$con = mysql_connect($dbhost,$dbuser,$dbpass) or die (mysql_error());
		mysql_select_db($dbname,$con) or die (mysql_error());  

		$notiftab = $dbprefix.'notifications';

		$query = 'select * from '.$notiftab;
		$result = mysql_query($query, $con);
		while ($row = mysql_fetch_array($result))
		{
			$notifhead = $row['notif_head'];
			$notifbo = $row['notif_desc'];
			$notiftm = explode(' ',$row['notif_date']);
			echo '<div class="block_public">
            <h5 class="name_ntc" style="color:#A31919;"><img class="arrow" src="images/arrow.png" />'.$notifhead.'</h5></br></br>
            <p class="p_ntc">'.$notifbo.'</p><sub style="padding-left:30px;">Published on : '.$notiftm[0].' at '.$notiftm[1].'</sub>
            </br> </div>';
		}
    ?>
    </div>
    </marquee>
    </div>
</div>
</div>
<div class="sitelink" style="margin-left:43%;padding-top:20px;padding-bottom:20px;">
	<a href="http://pesit.pes.edu"><img style="height:70px; width:130px;" src="images/pes_logo.gif" alt="peslogo"/></a>
</div>
</body>
</html>
