<?php
require './config.php';


function hash_internal_user_password($password) 
{
    global $CFG;
    return md5($password.$CFG->passwordsaltmain);
}
$str = 'fac123';
echo hash_internal_user_password($str);
$usn = 'sdfsdf';
$subject = 'sdfsdf';
$atten = 'asfas';
echo "INSERT INTO ".$atttable."(USN,subject,percentage) VALUES ('".$usn."','".$subject."','".$atten."')";
//$a = "abcd,efgh,ijkl";
//$arr = explode(',',$a);
//echo sizeof($arr);
echo "\n";
?>
