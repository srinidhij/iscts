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
$marksdata = new Spreadsheet_Excel_Reader();
$marksdata->read($_SESSION['upfile']);

// Set output Encoding.
$marksdata->setOutputEncoding('CP1251');

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

$markstab = $dbprefix.'marks';

mysql_query("CREATE TABLE IF NOT EXISTS ".$markstab."(
    USN varchar(11) not null,
    subject varchar(10) not null,
    marks varchar(10) not null,
    test varchar(10) not null
    )",$con) or die(mysql_error());

for ($i = 1; $i <= $marksdata->sheets[0]['numRows']; $i++) 
{
	$atten = '';
	$usn = '';
	$subject = '';
	$attended = '';
	$tot = '';
	for ($j = 1; $j <= $marksdata->sheets[0]['numCols']; $j++) 
	{
		if($j == 1)
		{
			$usn = $marksdata->sheets[0]['cells'][$i][$j];
			echo '<br/>'.$usn.'<br/>';
		}
		else if ($j == 2)
		{
			$subject = $marksdata->sheets[0]['cells'][$i][$j];
			echo '<br/>'.$subject.'<br/>';

		}
		else if ($j == 3)
		{
			$marks = $marksdata->sheets[0]['cells'][$i][$j];
			echo '<br/>'.$marks.'<br/>';

		}
		else if ($j == 4)
		{
			$test = $marksdata->sheets[0]['cells'][$i][$j];
			echo '<br/>'.$test.'<br/>';
		}
	}
	$query = "INSERT INTO ".$markstab."(USN,subject,marks,test) VALUES('".$usn."','".$subject."','".$marks."','".$test."')";
	echo $query;
	mysql_query($query,$con) or die(mysql_error());
	
	echo 'Success<br/>';
}
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=upattsucc.php">';
