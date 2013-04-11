<?php
session_start();

if (!isset($_SESSION['isvalins']) || $_SESSION['isvalins'] == false)
{
    echo 'Error invalid installation';
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">'; 
    die;
}
function complex_random_string($length=null) {
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
$dbhost=$_POST['dbhost'];
$dbname=$_POST['dbname'];
$dbuser=$_POST['dbuser'];
$dbpass=$_POST['dbpass'];
$wwwroot=$_POST['wwwroot'];
$dataroot=$_POST['dataroot'];
$prefix=$_POST['prefix'];
$admin=$_POST['admin'];
$passwordsaltmain = complex_random_string();

$configfile = "./config.php";

$begin = "<?php\n //Course Manager Configuration file\nunset(\$CFG);\nglobal \$CFG ;\n \$CFG=new stdClass();
\n\$CFG->dbtype='mysqli';\n\$CFG->dblibrary='native';\n";
$host = "\$CFG->dbhost='".$dbhost."';\n";
$name = "\$CFG->dbname='".$dbname."';\n";
$user = "\$CFG->dbuser='".$dbuser."';\n";
$pass = "\$CFG->dbpass='".$dbpass."';\n\n";
$wroot = "\$CFG->wwwroot='".$wwwroot."';\n";
$droot = "\$CFG->dataroot='".$dataroot."';\n";
$pfix = "\$CFG->prefix='".$prefix."';\n";
$adm = "\$CFG->admin='".$admin."';\n";
$psw = "\$CFG->passwordsaltmain='".$passwordsaltmain."';\n\n";
$end = "// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!";

$data = $intro.$begin.$host.$name.$user.$pass.$wroot.$droot.$pfix.$adm.$psw.$end;

try{
    $cfgfp = fopen($configfile, 'w');
}
catch(Exception $e)
{
    echo $e;
    exit;
}

if ($cfgfp == false)
{
    echo "<html><body><h1>Error unable to create file</h1>";
    echo "<p>To continue copy paste this into a file config.php</p>";
    echo "<p>".$data."</p>";
}

try{
fwrite($cfgfp,$data);
fclose($cfgfp);
chown("./config.php",'www-data');
chmod("./config.php",0644);
}
catch(Exception $e)
{
    echo $e;
    exit;
}
require_once('./createdb.php');
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">'; 
?>