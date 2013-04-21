<?php
session_start();
$_SESSION['isvalins'] = false;
if (!file_exists('./config.php')) {
	$_SESSION['isvalins'] = true;
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=getdata.php">'; 
    die;
}
if ($_SESSION['isloggedin'] == true)
{
	if($_SESSION['usrtype'] == "stud")
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=studentHome.php">'; 
}
if(isset($_SESSION['dbdone']))
{
	echo 'Databases created';
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
	<style type="text/css">
	body{
		background: #FDFEFF;
	}
	div.pagewrapper{
		margin-top: 1%;
		margin-left: 1%;
		width: 98%;
		height: 100%;
		padding-top: 2%;
		padding-bottom: 10%;
		background: #f5f5f5;
		overflow:hidden;
	}
	div.header{
		height: 50px;
		width:100%;
		background: #eeeeee;
		padding-top: 15px;
	}
	div.pageheader{
		border: 3px #A58C8C solid;
		position: relative;
		margin-left: 10%;
		padding: 0.4%;
		width: 80%;
		float: center;
		background: rgba(0,191,255,0.6);;
	}
	div.notifcontainer{
		padding-left: 30px;
		padding-top: 10px;
	}

	      h5.name_ntc
      {
       float:left; 
       font-family:anton; 
       text-align:left;
       padding:10px;
       margin:0px;
       padding-bottom:1px;
       color:#092256; 
       text-shadow: 0.1em 0.1em #333;
       }
      p.p_ntc
      {
       color:#020014;
       font-family: cursive;
       padding:5px;
       margin-left:15px;
       text-align:left;
      }
	  div.block_public
      {
       
       -moz-box-shadow: 3px 3px 4px #000;
       -webkit-box-shadow: 3px 3px 4px #000;
       box-shadow: 10px 10px 4px #7D7D7D;
       background-color:#8DE28D;
       width:50%;
       height:auto;
       min-height:110px;
       margin-left:15px;
       margin-top:15px;
       margin-right:15px;
       margin-bottom:20px;
       border-radius:20px;
       -webkit-border-radius:20px;
       -moz-border-radius:20px;
     /*  border:2px solid blue;*/
       }

	td.loginfo{
		font-size: 22;
		font-weight: bold;
		padding-top: 1px;
	}
	td{
		padding : 7px;
	}
	td.radbut{
		padding-left: 70px;
	}
	div.userlogin
	{
		border: 3px #bbbbbb solid;
		height: 400px;
		width:300px;
		background: #dddddd;
		float: right;
		/*margin:auto;*/
		margin-top: 35px;
		margin-right: 1.5%; 
		padding-right: 30px;
		padding-bottom: 30px;
		padding-left: 40px;
		padding-right: 45px;
		padding-top: 10px;
		margin-left: 50px;
		margin-right: 50px;
	}
	input.submit{
		width: 150px;
	}
	h3{
		font-family: calibre;
		font-size: 25;
		font-color: #1919a3;
		text-shadow :0.08em 0.08em 0.08em #1919a3;
	}
	</style>

<script type="text/javascript">
/*
$(function () {

    var check = new RegExp("[0-9][A-Z][A-Z][0-9][0-9][A-Z][A-Z][0-9][0-9][0-9]", "g");

    $("#asdf").blur(function () {

        var text = $("#asdf").val();

        var match = check.exec(text);

        if (match == null)
            $('#qwer').html('INVALID');
        
        else if (match[0] === text)
            $('#qwer').html('VALID');

    });

});*/
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
}
</script>
</head>
<body>
	<!--
		<div class="header">

		<span style="margin-left:10%">ISCTS</span>
		<span style="margin-left:70%">you are not logged in </span>
	</div>
-->
<div class="pagewrapper">

	<div class="pageheader">
		<h1 align="center">Welcome to ISCTS</h1>
		<br/>
		<h3 align="center"> DEPARTMENT OF ISE</h3>
	</div>
	<div class="userlogin">
		<h2 align="center"> Login </h2>
		<br/>
		<form action="./loginauth.php" method="post">
			<table>

				<tr><td class="loginfo">Username</td><td><input type="text" name="username" id="username"/></td></tr>
				<tr><td class="loginfo">Password</td><td><input type="password" name ="password"/></td></tr>
				<tr><td class="radbut"><input type="radio" name="logintype" id ="loginstud" value="Student" checked> </td><td>Student</td></tr>
				<tr><td class="radbut"><input type="radio" name="logintype" id ="loginfac" value="Faculty"></td><td> Faculty </td></tr>
				<tr><td class="radbut"><input type="radio" name="logintype" id ="loginadm" value="Admin"></td><td> Admin </td></tr>
			</table>
					<br/>
					<input type= "submit" value="LOGIN" class="btn btn-large btn-block btn-info"/>
				
			<p id="status_stop"></p>
		</form>
		<a style="padding-left:100px" href="./forgot.php">Forgot Password</a>
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
