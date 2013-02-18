<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['attempts']);
unset($_SESSION['wrongpass']);
unset($_SESSION['isvalins']);
unset($_SESSION['usrtype']);
unset($_SESSION['isloggedin']);
session_unset();
session_destroy();
echo 'Logged out';
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">'; 
?>
