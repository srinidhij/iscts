<?php
session_start();

if(!isset($_SESSION['isvalins']) || !$_SESSION['isvalins'])
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
	die;
}
require('./config.php');

$con = mysql_connect($CFG->dbhost,$CFG->dbuser,$CFG->dbpass) or die(mysql_error());
$dbcreatqry = 'CREATE DATABASE IF NOT EXISTS '.$CFG->dbname.' DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;';
mysql_query($dbcreatqry,$con) or die(mysql_error());

echo "Database ". $CFG->dbname." created\n";

mysql_select_db($CFG->dbname,$con) or dir(mysql_error());

$tablecreatqry = 'CREATE TABLE IF NOT EXISTS '.$CFG->prefix.'students (USN varchar(11) PRIMARY KEY,
    name varchar(30) not null, 
    semester int not null,
    email varchar(50) not null);';
echo $tablecreatqry;
 mysql_query($tablecreatqry,$con) or die(mysql_error()); 
$_SESSION['dbdone'] = true;
echo 'in create db';
?>