<?php
session_start();
$ds = '/';
$store='uploads';
if(!empty($_FILES))
{
	$tmpfile = $_FILES['file']['tmp_name'];
	$storepath = './uploads/';
	$storefile = $storepath.$_FILES['file']['name'];
	move_uploaded_file($tmpfile, $storefile);
	if (strpos($_FILES['file']['name'], 'stud') !== false)
	{
		$_SESSION['studfile'] = $storefile;
	}
	else if (strpos($_FILES['file']['name'], 'fac') !== false)
	{
		$_SESSION['facfile'] = $storefile;		
	}
}
?>