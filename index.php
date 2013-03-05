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
	<title>Welcome to Course Manager</title>
	<style type="text/css">
	body{
		background: #eeeeee;
	}
	</style>
	<script src="jquery.min.js">
</script>
<script type="text/javascript">
function init() {
	key_count_global = 0; // Global variable
	document.getElementById("username").onkeypress = function() {
		key_count_global++;
		setTimeout("lookup("+key_count_global+")", 1000);//Function will be called 1 second after user types anything. Feel free to change this value.
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
<h1>Welcome to course manager</h1>
<?php
if ($_SESSION['wrongpass'] == true)
{
	echo 'Wrong username or password';
}
?>
<form action="./loginauth.php" method="post">
	<table>
		<tr><td>Username</td><td><input type="text" name="username" id="username"/></td></tr>
		<tr><td>Password</td><td><input type="password" name ="password"/></td></tr>
		<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td style="padding-left:35px;"><input type= "submit" value="submit"/></td></tr>
	</table>
	<p id="status_stop"></p>
</form>
</body>
</html>
