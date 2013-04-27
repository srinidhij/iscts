<?php
$user = $_GET['username'];
$pass = $_GET['password'];
if($user=="abc" && $pass == "xyz")
{
	$_SESSION['user'] = $user;
	echo 'success';	
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=success.php?">';    

}
else
{
	    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=fail.php">';    
}
?>
