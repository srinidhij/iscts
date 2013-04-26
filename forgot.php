<?php

require_once 'reader.php';
require_once "./php/Mail.php";
require_once './config.php';

$type = $_POST['type'];
$emailid = $_POST['emailp'];
//$type="student";
//$emailid="srinidhij.21@gmail.com";
function complex_random_string($length=null) 
{
    $pool  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $pool .= '`~!@#%^&*()_+-=[];,./<>?:{} ';
    $poollen = strlen($pool);
    mt_srand ((double) microtime() * 1000000);
    if ($length===null) {
        $length = floor(rand(24,32));
    }
    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $string .= $pool[(mt_rand()%$poollen)];
    }
    return $string;
}

function hash_internal_user_password($password) 
{
    global $CFG;
    return md5($password.$CFG->passwordsaltmain);
}


$host = "ssl://plus.smtp.mail.yahoo.com";        // Authentication for email id,
$port = "465";
$username = "isctsise@yahoo.com"; 
$onbpass = "@adminisctsISE";
$from = "isctsise@yahoo.com";

$subject = "Hi! Your Reset Password ISCTS details are : ";
$bodystart = "Your Username for ISCTS is : ";
$bodymiddle="\nYour Password is: ";

$tmp_pass = complex_random_string(rand(10,15));

$bodyend = "\nPlease change your password after your first login.";

global $CFG;
$dbhost = $CFG->dbhost;
$dbuser = $CFG->dbuser;
$dbname = $CFG->dbname;
$dbpass = $CFG->dbpass;
$dbprefix = $CFG->prefix;

$con = mysql_connect($dbhost,$dbuser,$dbpass) or die (mysql_error());
mysql_select_db($dbname,$con) or die (mysql_error());

if ($type == 'student')
{
	$usn = null;
	$name = null;
	$query = "SELECT USN,name FROM ".$dbprefix."students WHERE email='".$emailid."'";
	//echo $query;
	$result = mysql_query($query,$con);
	if ($result)
	{
		while($row = mysql_fetch_array($result))
		{
			$usn = $row['USN'];
			$name = $row['name'];
		}


		if (!(($usn == '' or $usn==null) or ($name == '' or $name==null)))
		{
			echo $name;
			$newhpass  = hash_internal_user_password($tmp_pass);
			//echo $query;
			$query =  "UPDATE ".$dbprefix."students SET pass='".$newhpass."' WHERE email='".$emailid."'";
			mysql_query($query);
	   		$to = $emailid;
	        //echo $to;
	        $body ="Hello ".$name."\n".$bodystart.$usn.$bodymiddle.$tmp_pass.$bodyend;
	        $headers = array ('From' => $from,
	          'To' => $to,
	          'Subject' => $subject);
	        $smtp = Mail::factory('smtp',
	          array ('host' => $host,
	            'port' => $port,
	            'auth' => true,
	            'username' => $username,
	            'password' => $onbpass));
	        //echo $body;
	        $mail = Mail::factory("mail");
	        try
	        {
	        	$mailt = $mail->send($to, $headers, $body);
	        }
	        catch (Exception $e)
	        {
	        	echo 'Error occured';
	        }
	        if (PEAR::isError($mailt)) 
	        {
	        	echo '<h1>Error occured while sendin mail</h1>';
	            echo($mailt->getMessage());
	        } 
	        else 
	        {
	          echo "<h4>Success ".$usn.", sent password to ".$emailid.'</h4>';
	        }
	        echo 'H1';
		}
		header('location','index.php');
	}
}
else if($type == 'fac')
{
	$id = null;
	$name = null;
	$query = "SELECT USN,name FROM ".$dbprefix."faculty WHERE email='".$emailid."'";
	$result = mysql_query($query,$con);
	if ($result)
	{
		while($row = mysql_fetch_array($result))
		{
			$id = $row['id'];
			$name = $row['name'];
		}
		if (!(($id == '' or $id==null) or ($usn == '' or $usn==null)))
		{
			$query =  "UPDATE ".$dbprefix."faculty SET pass='".$newhpass."' WHERE email='".$emailid."'";
			mysql_query($query);

	   		$to = $emailid;
	        //echo $to;
	        $body ="Hello ".$name."\n".$bodystart.$id.$bodymiddle.$tmp_pass.$bodyend;

	        $headers = array ('From' => $from,
	          'To' => $to,
	          'Subject' => $subject);
	        $smtp = Mail::factory('smtp',
	          array ('host' => $host,
	            'port' => $port,
	            'auth' => true,
	            'username' => $username,
	            'password' => $onbpass));

	        $mail = $smtp->send($to, $headers, $body);

	        if (PEAR::isError($mail)) {
	          echo($mail->getMessage());
	         } else {
	          echo "<h4>Success ".$usn.", sent password to ".$email.'</h4>';
	         }
		}
	}
}
else
{
	$id = null;
	$name = null;
	$query = "SELECT USN,name FROM ".$dbprefix."admin WHERE email='".$emailid."'";
	$result = mysql_query($query,$con);
	if ($result)
	{
		while($row = mysql_fetch_array($result))
		{
			$id = $row['id'];
			$name = $row['name'];
		}
		if (!(($id == '' or $id==null) or ($usn == '' or $usn==null)))
		{
			$query =  "UPDATE ".$dbprefix."admin SET pass='".$newhpass."' WHERE email='".$emailid."'";
			mysql_query($query);

	   		$to = $emailid;
	        //echo $to;
	        $body ="Hello ".$name."\n".$bodystart.$id.$bodymiddle.$tmp_pass.$bodyend;

	        $headers = array ('From' => $from,
	          'To' => $to,
	          'Subject' => $subject);
	        $smtp = Mail::factory('smtp',
	          array ('host' => $host,
	            'port' => $port,
	            'auth' => true,
	            'username' => $username,
	            'password' => $onbpass));

	        $mail = $smtp->send($to, $headers, $body);

	        if (PEAR::isError($mail)) {
	          echo($mail->getMessage());
	         } else {
	          echo "<h4>Success ".$usn.", sent password to ".$email.'</h4>';
	         }
		}
	}

}