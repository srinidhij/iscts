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

echo "<html><body><h1>Database ". $CFG->dbname." created";

$_SESSION['dbdone'] = true;

echo 'in create db </h1></body></html>';
require 'getFile.php' 

?>