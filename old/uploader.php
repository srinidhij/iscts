<?php
require_once("./config.php");
global $addrs;
global $CFG;
session_start();
if ($_FILES["studfile"]["error"] > 0)
  {
  echo "Error: " . $_FILES["studfile"]["error"] . "<br />";
  die;
  }
if ($_FILES["facfile"]["error"] > 0)
  {
  echo "Error: " . $_FILES["facfile"]["error"] . "<br />";
  die;
  }

else
  {
   /*if($_FILES["facfile"]["type"] != 'application/vnd.ms-excel' || $_FILES["studfile"]["type"] != 'application/vnd. ms-excel' )
    {
     echo "Please upload a excel file";
    }
    else
     {*/
      //require('./create_and_send.php');
      echo "Upload: " . $_FILES["studfile"]["name"] . "<br />";
      echo "Type: " . $_FILES["studfile"]["type"] . "<br />";
      echo "Size: " . ($_FILES["studfile"]["size"] / 1024) . " Kb<br />";
      echo "Stored in: " . $_FILES["studfile"]["tmp_name"]; 
      echo 'asdasfad';

      echo "<br/>Upload: " . $_FILES["facfile"]["name"] . "<br />";
      echo "Type: " . $_FILES["facfile"]["type"] . "<br />";
      echo "Size: " . ($_FILES["facfile"]["size"] / 1024) . " Kb<br />";
      echo "Stored in: " . $_FILES["facfile"]["tmp_name"]; 
   

    if (file_exists("./upload/" . $_FILES["studfile"]["name"]))
      {
        echo $_FILES["studfile"]["name"] . " already exists. ";
      }
    else
      {
        $studata = fread($_FILES["studfile"]["tmp_name"]);
        $fps = fopen("./upload/" . $_FILES["studfile"]["name"],'w');
        fwrite($fps,$studata);
      }

      echo 'in asjhdb';
     
    if (file_exists("upload/" . $_FILES["facfile"]["name"]))
      {
        echo $_FILES["facfile"]["name"] . " already exists. ";
      }
    else
      {
        $facdata = fread($_FILES["facfile"]["tmp_name"]);
        $fpf = fopen("./upload/" . $_FILES["facfile"]["name"],'w');
        fwrite($fps,$facdata);

      } 
      $_SESSION['studfile'] = $_FILES["studfile"]["name"];
      $_SESSION['facfile'] = $_FILES["facfile"]["name"];
      echo '<br/>Done ...<br/>';
      include 'create_and_send.php';

 }
/*
  if (file_exists("uploadedfiles/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      $addrs->path= "" . "uploadedfiles/" . $_FILES["file"]["name"]."";
      echo "\n File path to be stored".$addrs->path."\n";
   if( move_uploaded_file($_FILES["file"]["tmp_name"],"uploadedfiles/" . $_FILES["file"]["name"]))
      {
         
        //require("example.php");
       echo "\n File moved";
      }
      
         
 }  */
?>