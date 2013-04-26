<?php
echo '<html><body>';
require_once 'reader.php';
require_once "./php/Mail.php";
require_once './config.php';
session_start();
// ExcelFile($filename, $encoding);
if (!isset($_SESSION['upfile']))
{
  echo '<h1>File does not exist</h1>';
}
$attf = fopen($_SESSION['upfile'],'r'); 
$attdata = new Spreadsheet_Excel_Reader();
$attdata->read($_SESSION['upfile']);

// Set output Encoding.
$attdata->setOutputEncoding('CP1251');

function hash_internal_user_password($password) 
{
    global $CFG;
    return md5($password.$CFG->passwordsaltmain);
}


$dbhost = $CFG->dbhost;
$dbuser = $CFG->dbuser;
$dbname = $CFG->dbname;
$dbpass = $CFG->dbpass;
$dbprefix = $CFG->prefix;
$con = mysql_connect($dbhost,$dbuser,$dbpass) or die (mysql_error());
mysql_select_db($dbname,$con) or die ("unable to select");  

$atttable = $dbprefix.'attendance';

mysql_query("CREATE TABLE IF NOT EXISTS ".$atttable."(
    USN varchar(11),
    subject varchar(10) not null,
    percentage varchar(10) not null
    )",$con) or die(mysql_error());

for ($i = 1; $i <= $attdata->sheets[0]['numRows']; $i++) 
{
	$atten = '';
	$usn = '';
	$subject = '';
	$attended = '';
	$tot = '';
	for ($j = 1; $j <= $attdata->sheets[0]['numCols']; $j++) 
	{
		if($j == 1)
		{
			$usn = $attdata->sheets[0]['cells'][$i][$j];
			echo '<br/>'.$usn.'<br/>';
		}
		else if ($j == 2)
		{
			$subject = $attdata->sheets[0]['cells'][$i][$j];
			echo '<br/>'.$subject.'<br/>';

		}
		else if ($j == 3)
		{
			$attended = $attdata->sheets[0]['cells'][$i][$j];
			echo '<br/>'.$attended.'<br/>';

		}
		else if ($j == 4)
		{
			$tot = $attdata->sheets[0]['cells'][$i][$j];
			echo '<br/>'.$tot.'<br/>';
		}
	}
	$atten = strval($attended).'/'.strval($tot);
	$query = "INSERT INTO ".$atttable."(USN,subject,percentage) VALUES('".$usn."','".$subject."','".$atten."')";
	echo $query;
	mysql_query($query,$con) or die(mysql_error());
	
	echo 'Success<br/>';
}
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=upattsucc.php">';
