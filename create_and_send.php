<?php
echo '<html><body><br/>jsdfjasdfkasdhf';
require_once 'reader.php';
require_once "./php/Mail.php";
require_once './config.php';
session_start();
// ExcelFile($filename, $encoding);
if (!isset($_SESSION['studfile']) || !isset($_SESSION['facfile']))
{
  echo '<br/>File does not exist<br/>';
}
$studdata = new Spreadsheet_Excel_Reader($_SESSION['studfile']);
$facdata = new Spreadsheet_Excel_Reader($_SESSION['facfile']);


// Set output Encoding.
$studdata->setOutputEncoding('CP1251');
$facdata->setOutputEncoding('CP1251');

 //if you want you can change 'iconv' to mb_convert_encoding:
//$data->setUTFEncoder('mb');
/*
**/
echo '<p>asdfasdfasdf</p>';
/***
* By default rows & cols indeces start with 1
* For change initial index use:
* $data->setRowColOffset(0);
*
**/



/***
*  Some function for formatting output.
* $data->setDefaultFormat('%.2f');
* setDefaultFormat - set format for columns with unknown formatting
*
* $data->setColumnFormat(4, '%.3f');
* setColumnFormat - set format for column (apply only to number fields)
*
**cd /
//echo $studdata.'<br/>'.$facdata;

/*


 $data->sheets[0]['numRows'] - count rows
 $data->sheets[0]['numCols'] - count columns
 $data->sheets[0]['cells'][$i][$j] - data from $i-row $j-column

 $data->sheets[0]['cellsInfo'][$i][$j] - extended info about cell
    
    $data->sheets[0]['cellsInfo'][$i][$j]['type'] = "date" | "number" | "unknown"
        if 'type' == "unknown" - use 'raw' value, because  cell contain value with format '0.00';
    $data->sheets[0]['cellsInfo'][$i][$j]['raw'] = value if cell without format 
    $data->sheets[0]['cellsInfo'][$i][$j]['colspan'] 
    $data->sheets[0]['cellsInfo'][$i][$j]['rowspan'] 
*/

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


/* $con = mysql_connect("$CFG->dbhost","$CFG->dbuser","$CFG->dbpass") or die ("mysql_error()");
mysql_select_db("$CFG->dbname",$con) or die ("unable to select");*/
//error_reporting(E_ALL ^ E_NOTICE);

$studtable = $dbprefix.'students';
$factable = $dbprefix.'faculty';
mysql_query("DROP TABLE IF EXISTS ".$studtable, $con);
mysql_query("DROP TABLE IF EXISTS ".$factable, $con);
mysql_query("CREATE TABLE IF NOT EXISTS ".$studtable."(
    USN varchar(11) PRIMARY KEY,
    pass varchar(50) not null,
    name varchar(30) not null, 
    semester int not null,
    email varchar(50) not null,
    mobile varchar(33),
    clist varchar(50))",$con) or die(mysql_error());


mysql_query("CREATE TABLE IF NOT EXISTS ".$factable."(
    id varchar(10) PRIMARY KEY,
    pass varchar(50) not null,
    name varchar(30) not null, 
    email varchar(50) not null,
    mobile varchar(33),
    clist varchar(50))",$con) or die(mysql_error());
echo '<br/>fhasdfkhs<br/>';

$host = "ssl://smtp.gmail.com";        // Authentication for email id,
$port = "465";
$username = "onbpesit@gmail.com"; 
$onbpass = "@moodleONB1";
$from = "onbpesit@gmail.com";

$subject = "Hi! Your ISCTS account registration details are : ";
$bodystart = "Your Username for ISCTS is : ";
$bodymiddle="\nYour Password is: ";
$bodyend = "\nPlease change your password after your first login.";

for ($i = 1; $i <= $studdata->sheets[0]['numRows']; $i++) 
{ 
  $usn="null";
  $name="null";
  $sem="null";
  $email="null";
  for ($j = 1; $j <= $studdata->sheets[0]['numCols']; $j++) 
  {
  //	echo "".$data->sheets[0]['cells'][$i][$j]."";

  if($j==1)
    $usn=$studdata->sheets[0]['cells'][$i][$j];
  else if($j==2) 
    $name=$studdata->sheets[0]['cells'][$i][$j];
  else if($j==3)
    $sem=$studdata->sheets[0]['cells'][$i][$j];    
  else if ($j == 4)
    $email=$studdata->sheets[0]['cells'][$i][$j]; 
  else if ($j == 5)
    $mobile=$studdata->sheets[0]['cells'][$i][$j]; 
  else 
    $clist = $studdata->sheets[0]['cells'][$i][$j]; 
  }
  $tmp_pass=rand();
  $password=hash_internal_user_password($tmp_pass);
  $usr=strtolower($usn);
  // echo "name: ".$usr." pass: ".$tmp_pass."\n";
   
   mysql_query("INSERT INTO ".$studtable."(USN,pass,name,semester,email,mobile,clist) VALUES('$usr','$password','$name','$sem','$email','$mobile','$clist')",$con) or die(mysql_error());
  
   $to = "$email";
        //echo $to;
        $body ="Hello ".$name."\n".$bodystart.$usr.$bodymiddle.$tmp_pass.$bodyend;

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
        echo 'Done';
        if (PEAR::isError($mail)) {
          echo($mail->getMessage());
         } else {
          echo("Message successfully sent!");
         }
   //mysql_query("INSERT INTO onb_user(confirmed,mnethostid,username,password,firstname,lastname,email) VALUES (1,1,'$usn','$password','$name',' ','$email')",$con) or die(mysql_error());
  //header("location:$CFG->wwwroot");    
}

for ($i = 1; $i <= $facdata->sheets[0]['numRows']; $i++) 
{ 

  for ($j = 1; $j <= $facdata->sheets[0]['numCols']; $j++) 
  {
  //  echo "".$data->sheets[0]['cells'][$i][$j]."";
    echo ''.$facdata->sheets[0]['cells'][$i][$j].'';
  if($j==1)
    $id=$facdata->sheets[0]['cells'][$i][$j];
  else if($j==2) 
    $name=$facdata->sheets[0]['cells'][$i][$j];
  else if ($j == 3)
    $email=$facdata->sheets[0]['cells'][$i][$j]; 
  else if ($j == 4)
    $mobile=$facdata->sheets[0]['cells'][$i][$j]; 
  else 
    $clist = $facdata->sheets[0]['cells'][$i][$j]; 
  }
  $tmp_pass=rand();
  $password=hash_internal_user_password($tmp_pass);
  // echo "name: ".$usr." pass: ".$tmp_pass."\n";
   echo "INSERT INTO ".$factable."(id,pass,name,email,mobile,clist) VALUES('$id','$password','$name','$email','$mobile','$clist')";
   mysql_query("INSERT INTO ".$factable."(id,pass,name,email,mobile,clist) VALUES('$id','$password','$name','$email','$mobile','$clist')",$con) or die(mysql_error());
  
   $to = "$email";
        //echo $to;
        $body ="Hello ".$name."\n".$bodystart.$usr.$bodymiddle.$tmp_pass.$bodyend;

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
          echo("Message successfully sent!");
         }
   //mysql_query("INSERT INTO onb_user(confirmed,mnethostid,username,password,firstname,lastname,email) VALUES (1,1,'$usn','$password','$name',' ','$email')",$con) or die(mysql_error());
  //header("location:$CFG->wwwroot");    
}
echo '</body>
</html>';
?>
