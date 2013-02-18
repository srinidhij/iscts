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

$CFG->wwwroot='http://localhost/iscts';
$CFG->dataroot='http://localhost/testd';
$CFG->prefix='iscts_';
$CFG->admin='admin';
$CFG->passwordsaltmain='BZ#{lk{I5~z8D%7]6>hcw{_fjc';

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!