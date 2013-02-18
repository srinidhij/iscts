<?php
session_start();
if($_SESSION['isvalins'] == false)
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
    die;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title>Install Course man software</title>
    <style type="text/css">
    body{
        background: #eeeeee;
    }
    </style>
</head>
<body>
    <form action="install.php" method="post">
        <table>
            <tr><td>Database Host</td><td><input type="text" name="dbhost"/></td></tr>
            <tr><td>Database Name</td><td><input type="text" name="dbname"/></td></tr>
            <tr><td>Database User</td><td><input type="text" name="dbuser"/></td></tr>
            <tr><td>Database Password</td><td><input type="password" name="dbpass"/></td></tr>
            <tr><td>wwwroot</td><td><input type="text" name="wwwroot"/></td></tr>
            <tr><td>Data root</td><td><input type="text" name="dataroot"/></td></tr>
            <tr><td>Table prefix</td><td><input type="text" name="prefix"/></td></tr>
            <tr><td>Admin Name</td><td><input type="text" name="admin"/></td></tr>
            <tr><td><input type="submit" value="submit"/></td></tr>
        </table>
    </form>
</body>
</html>