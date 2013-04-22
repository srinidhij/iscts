<?php
session_start();
$_SESSION['isloggedin'] = true;
$_SESSION['usrtype'] = "adm";
echo 'Logged in successfully as '.$_SESSION['user'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link href='./favicon.ico' rel='icon' type='image/x-icon' />
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="calendar/css/style.css">
	<title>Student Home</title>
	
	<style type="text/css">
	body{
		background: #eeeeee;
	}
	div.pagewrapper{
		margin-top: 1%;
		margin-left: 1%;
		width: 98%;
		height: 100%;
		padding-top: 2%;
		padding-bottom: 10%;
		background: #f5f5f5;
		overflow:hidden;
	}
	h3{
		text-align: center;
		font-family: calibre;
		font-size: 25;
		font-color: #1919a3;
		text-shadow :0.08em 0.08em 0.08em #1919a3;
	}

	div.calendar{
		padding: 30px;
		float: right;
	}
	</style>
</head>
<body>
	<div class="navbar navbar-fixed-top">  
  <div class="navbar-inner">  
    <div class="container">  
<ul class="nav">  
  <li class="active">  
    <a class="brand" href="#">View profile</a>  
  </li>  
  <li><a href="attendance.php">View Attendance</a></li>  
  <li><a href="marks.php">View Marks</a></li>  
  <li><a href="centact.php">Contact</a></li>
    <li><a href="logout.php">Logout</a></li>
  
</ul>    <!--navigation does here-->  
    </div>  
  </div>  
</div>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <!--<![endif]-->
<div class="pagewrapper">
<div class="calendar">
	<h3>CALENDAR</h3>
  <table class="datepicker">
    <caption class="datepicker-caption">
      <a href="calendar/calendar/index.html" class="datepicker-prev">Previous</a>
      <span class="datepicker-title">April 2013</span>
      <a href="calendar/calendar/index.html" class="datepicker-next">Next</a>
    </caption>
    <thead class="datepicker-head">
      <tr>
        <th class="datepicker-th">Mo</th>
        <th class="datepicker-th">Tu</th>
        <th class="datepicker-th">We</th>
        <th class="datepicker-th">Th</th>
        <th class="datepicker-th">Fr</th>
        <th class="datepicker-th">Sa</th>
        <th class="datepicker-th">Su</th>
      </tr>
    </thead>
    <tbody class="datepicker-body">
      <tr>
        <td class="datepicker-td"><a href="calendar/calendar/index.html">1</a></td>
        <td class="datepicker-td"><a href="calendar/calendar/index.html">2</a></td>
        <td class="datepicker-td"><a href="calendar/calendar/index.html">3</a></td>
        <td class="datepicker-td"><a href="calendar/calendar/index.html">4</a></td>
        <td class="datepicker-td"><a href="calendar/calendar/index.html">5</a></td>
        <td class="datepicker-td"><a href="calendar/calendar/index.html">6</a></td>
        <td class="datepicker-td"><a href="calendar/calendar/index.html">7</a></td>
      </tr>
      <tr>
        <td class="datepicker-td"><a href="calendar/calendar/index.html">8</a></td>
        <td class="datepicker-td"><a href="calendar/calendar/index.html">9</a></td>
        <td class="datepicker-td today"><a href="calendar/calendar/index.html">10</a></td>
        <td class="datepicker-td"><a href="calendar/calendar/index.html">11</a></td>
        <td class="datepicker-td"><a href="calendar/calendar/index.html">12</a></td>
        <td class="datepicker-td"><a href="calendar/calendar/index.html">13</a></td>
        <td class="datepicker-td"><a href="calendar/calendar/index.html">14</a></td>
      </tr>
      <tr>
        <td class="datepicker-td"><a href="calendar/calendar/index.html">15</a></td>
        <td class="datepicker-td"><a href="calendar/calendar/index.html">16</a></td>
        <td class="datepicker-td"><a href="calendar/calendar/index.html">17</a></td>
        <td class="datepicker-td"><a href="calendar/calendar/index.html">18</a></td>
        <td class="datepicker-td"><a href="calendar/calendar/index.html">19</a></td>
        <td class="datepicker-td"><a href="calendar/index.html">20</a></td>
        <td class="datepicker-td"><a href="calendar/index.html">21</a></td>
      </tr>
      <tr>
        <td class="datepicker-td"><a href="calendar/index.html">22</a></td>
        <td class="datepicker-td"><a href="calendar/index.html">23</a></td>
        <td class="datepicker-td"><a href="calendar/index.html">24</a></td>
        <td class="datepicker-td"><a href="calendar/index.html">25</a></td>
        <td class="datepicker-td"><a href="calendar/index.html">26</a></td>
        <td class="datepicker-td"><a href="calendar/index.html">27</a></td>
        <td class="datepicker-td"><a href="calendar/index.html">28</a></td>
      </tr>
      <tr>
        <td class="datepicker-td"><a href="calendar/index.html">29</a></td>
        <td class="datepicker-td"><a href="calendar/index.html">30</a></td>
        <td class="datepicker-td off"><a href="calendar/index.html">1</a></td>
        <td class="datepicker-td off"><a href="calendar/index.html">2</a></td>
        <td class="datepicker-td off"><a href="calendar/index.html">3</a></td>
        <td class="datepicker-td off"><a href="calendar/index.html">4</a></td>
        <td class="datepicker-td off"><a href="calendar/index.html">5</a></td>
      </tr>
    </tbody>
  </table>
</div>
</div>
</body>
</html>