<?php
session_start();
$_SESSION['isvalins'] = false;
$iswrongpass = false;

if (!file_exists('./config.php')) {
	$_SESSION['isvalins'] = true;
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=getdata.php">'; 
    die;
}
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
if(isset($_SESSION['dbdone']))
{
	echo 'Databases created';
}
if(isset($_SESSION['wrongpass']) && $_SESSION['wrongpass'] == true)
{
	$iswrongpass = true;
	$wrongmsg = "Wrong password";
	unset($_SESSION['wrongpass']);
}
else
{
	$iswrongpass = false;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link href='./favicon.ico' rel='icon' type='image/x-icon' />
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<title>Welcome to Course Manager</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">

function valid() {
	// Function to validate usernamr based on type of user 
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

function valpass(){
	
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
});/*
function init() {
	key_count_global = 0; // Global variable
	document.getElementById("username").onkeypress = function() {
		key_count_global++;
		setTimeout("lookup("+key_count_global+")", 1000);//Function will be called 1 second after user types anything. 
	}
}
window.onload = init; //or $(document).ready(init); - for jQuery

function lookup(key_count) {
	if(key_count == key_count_global) { // The control will reach this point 1 second after user stops typing.
		// Do the ajax lookup here.
		var x = document.getElementById("username").value
		if(x.length != 3 || x.charAt(0) != '1' || x.charAt(1) != 'b')
		document.getElementById("status_stop").innerHTML = "<h5>Error</h5>";
	}
}*/
</script>
</head>
<body onload="init()">
	<!--
		<div class="header">

		<span style="margin-left:10%">ISCTS</span>
		<span style="margin-left:70%">you are not logged in </span>
	</div>
-->
<div class="pagewrapper">

	<div class="pageheader">
		<div style="float:left;padding:30px;">
		<span><a href="index.php"><h1>ISCTS</h1></a></span></div>
		<div style="float:center;">
	<a style="margin-left:20%" href="pes.edu"><img src="images/pesit-logo.png"></img></a>
	</div>
</div>
	<div class="userlogin">
		<h2 align="center"> Login </h2>
		<br/>
		<form action="./loginauth.php" method="post">
			<table>

				<tr><td class="loginfo">Username</td><td><input type="text" name="username" id="username"/></td></tr>
				<tr><td class="loginfo">Password</td><td><input type="password" name ="password" id="password"/></td></tr>
				<tr><td class="radbut"><input type="radio" name="logintype" id ="loginstud" value="student" checked> </td><td>Student</td></tr>
				<tr><td class="radbut"><input type="radio" name="logintype" id ="loginfac" value="faculty"></td><td> Faculty </td></tr>
				<tr><td class="radbut"><input type="radio" name="logintype" id ="loginadm" value="admin"></td><td> Admin </td></tr>
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
		<a style="padding-left:80px" href="./forgot.php">Forgot Password ?</a>
	</div>
	           	           <div class="notifcontainer">
	           	           	<h3 style="padding-left:300px;">Notifications</h3>
	           	                 <div class="block_public">
                        <h5 class="name_ntc"><img class="arrow" src="http://localhost/onb/moodle/pes_img/arrow.png" />Welcome </h5></br>
                        <p class="p_ntc">Please login to view your details</p>
                        </br>
                </div>
                	           	                 <div class="block_public">
                        <h5 class="name_ntc"><img class="arrow" src="http://localhost/onb/moodle/pes_img/arrow.png" />Welcome </h5></br>
                        <p class="p_ntc">Please login to view your details</p>
                        </br>
                </div>

	           	                 <div class="block_public">
                        <h5 class="name_ntc"><img class="arrow" src="http://localhost/onb/moodle/pes_img/arrow.png" />Welcome </h5></br>
                        <p class="p_ntc">Please login to view your details</p>
                        </br>
                </div>

            </div>
</div>
</body>
</html>
