<?php
require './config.php';


function hash_internal_user_password($password) 
{
    global $CFG;
    return md5($password.$CFG->passwordsaltmain);
}
$str = 'example';
echo hash_internal_user_password($str);
//$a = "abcd,efgh,ijkl";
//$arr = explode(',',$a);
//echo sizeof($arr);
echo "\n";
?>
