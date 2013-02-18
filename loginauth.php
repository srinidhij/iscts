<?php
session_start();
$user = $_POST['username'];
$pass = $_POST['password'];
if($user=="abc" && $pass == "xyz")
{
	$_SESSION['user'] = $user;
	echo 'success';	
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=studentHome.php">';    

}
else
{
	$_SESSION['wrongpass'] = true;
	if(!isset($_SESSION['attempts']))
	{
		$_SESSION['attempts'] = 0;
	} 
	else
	{
		$_SESSION['attempts'] += 1;
	}
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';    
}
?>
