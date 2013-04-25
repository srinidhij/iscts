<?php 
session_start();
/*
if(!isset($_SESSION['isvalins']) || !$_SESSION['isvalins'])
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
	die;
}*/
?> 
<html>
<head>
	<title>Upload file containing data</title>
	<link rel="stylesheet" type="text/css" href="css/flat-ui.css">
</head>
<body>
<p>
  Upload a excel sheet which contains student details in specified format 
</p>
<form name="input" action="uploader.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
<label for="studfile">studfilename:</label>
<input class="button"  type="file" name="studfile" id="studfile" /> 
<br />
<input class="btn btn-large btn-block btn-info"  type="file" name="facfile" id="facfile" /> 
<input class="btn btn-large btn-block btn-info" type="submit" name="submit" value="Submit" />
<a href="$CFG->wwwroot"><input class="button"  type="button" name="Cancel" value="Cancel"></a>
<p style="font-size:18;font-color:#2E2E2E;">
  Upload a excel sheet which contains faculty details in specified format 
</p>
</body>
</html>