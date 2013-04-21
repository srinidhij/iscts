<?php
 //Course Manager Configuration file
unset($CFG);
global $CFG ;
 $CFG=new stdClass();

$CFG->dbtype='mysqli';
$CFG->dblibrary='native';
$CFG->dbhost='localhost';
$CFG->dbname='iscts';
$CFG->dbuser='root';
$CFG->dbpass='resistant';

$CFG->wwwroot='http://localhost/iscsts';
$CFG->dataroot='http://localhost/iscsts/data';
$CFG->prefix='iscts_';
$CFG->admin='admin';
$CFG->passwordsaltmain='v`TO<Bp~-:]GJxCytiL{:V,vF-mNhS';

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!