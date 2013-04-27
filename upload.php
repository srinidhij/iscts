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
	$_SESSION['upfile'] = $storefile;		
	
}
?>