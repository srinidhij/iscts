<?php
$con = mysql_connect("localhost","root","resistant");
if (!$con){
	echo 'error';
	die(mysql_error());
}
mysql_select_db("cmanager",$con);
$query = "SELECT * FROM cm_user";
$result = mysql_query($query,$con);
while($row = mysql_fetch_assoc($result)) 
{
	echo $row['username']." , ";
	echo $row['id']."\n";
}
?>

