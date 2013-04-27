<?php
 //Course Manager Configuration file
 unset($CFG);
global($CFG);
 $CFG=new stdClass();

$CFG->dbtype='mysqli';
$dblibrary='native';
$CFG->dbhost='localhost';
$CFG->dbname='cmanager';
$CFG->dbuser='root';
$CFG->dbpass='resistant';

$CFG->wwwroot='http://localhost/cmanager';
$CFG->dataroot='http://localhost/testd';
$CFG->prefix='cm_';
$CFG->admin='';
$CFG->passwordsaltmain='f9c<P&mAy93B_xC.S#0H)8[hy.J4';

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
