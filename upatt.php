<?php 
session_start();
//if ($_SESSION['usrtype'] != 'adm' && $_SESSION['usrtype'] != 'fac')
//{
//	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
//	die;
//}
?>
<html>
<head>
	<script src="js/dropzone.js"></script>
	<script type="text/javascript">
	//var myDropzone = new Dropzone("div#test", { url: "http:localhost/iscts/uploader.php", paramName:"samplefile"});
	</script>
	<link rel="stylesheet" type="text/css" href="css/dropzone.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<style type="text/css">
	body{
		background-color: #8AC; 
	}
	div.continue{
		width: 20%;
		height: 50px;
		margin-left: 40%;
	}
	.dropzone{
		background-color: #DADAE6;
		height: 60%;
		width: 60%;
		float: center;
		margin-left: 20%;
		border: 2px #4D4DB8 solid;
	}
	.dropzone 
	.default.message {
		opacity: 1;
		-ms-filter: none;
		filter: none;
		-webkit-transition: opacity 0.3s ease-in-out;
		-moz-transition: opacity 0.3s ease-in-out;
		-o-transition: opacity 0.3s ease-in-out;
		-ms-transition: opacity 0.3s ease-in-out;
		transition: opacity 0.3s ease-in-out;
		background-image: url("images/spritemap.png");
		background-repeat: no-repeat;
		background-position: 0 0;
		position: absolute;
		width: 428px;
		height: 123px;
		margin-left: -214px;
		margin-top: -61.5px;
		top: 50%;
		left: 50%;
	}
	.dropzone .message {
		opacity: 1;
		-ms-filter: none;
		filter: none;
	}
	</style>
</head>
<body>
	<div class="pagewrapper">
		<h1 align="center" style="padding-bottom:40px;">Upload excel file which contains attendance info</h1>
	<form action="./upload.php" method="post" class="dropzone"> 
		<div class="default message">
			<span>Drop files here to upload</span>
		</div>
	</form>
	<div class="continue">
	<a href="doupatt.php" class="btn btn-large btn-block btn-info">Continue</a>
	</div>
</div>
</body>
</html>