<?php 
session_start();
if ($_SESSION['usrtype'] != 'adm' && $_SESSION['usrtype'] != 'fac')
{
	echo 'Hello';
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
	die;
}
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<style type="text/css">
	body
	{
		background-color: #8AC;
	}
	div.continue{
		height: 30px;
		width : 20%;
		margin-left: 40%;
	}
	</style>
</head>
<body>
	<div class="pagewrapper">
<h1 align="center">Updation successful</h1>
<div class="continue">
<a href="facultyHome.php" class="btn btn-large btn-block btn-info">Continue</a>
</div>
</div>
</body>
</html>