<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"
<title>Administrator Interface</title>
</head>

<body>
<center>
<h2>Search & View Quotes</h2><br><br>
<!--<h3><?=$message;?></h3>-->

<?php
$servername = 'blitz.cs.niu.edu';
$username = 'student';
$password = 'student';
$dbname = 'csci467';
$servername1 = 'courses';
$username1 = 'z1782120';
$password1 = '1997Oct05';
$dbname1 = 'z1782120';

global $date;
global $custName;
global $assocID;
global $status;

$mysqli = new mysqli($servername,$username,$password,$dbname);
$mysqli2 = new mysqli($servername1,$username1,$password1,$dbname1);

$message="";
if(isset($_GET['submit'])) {
   require 'connection.php';
   $date = $_GET['date'];
   echo $date."<br>";

   $sql = "SELECT * FROM quote WHERE date=$date";

   if($result=mysqli_query($mysqli2,$sql)) {
      //$result = mysqli_query($mysqli2,$sql);
      $results_num = mysqli_num_rows($result);

      if($results_num != 0) {
         $message = $results_num. "quote(s) retrieved successfully\n\n";
	 $results_num = 0; } //reset result count

      else $message = "Error: No quotes match those parameters\n\n";
      echo $message; }

   else echo "No date selected"; }

//echo nl2br($message);
?>

<form action="admin_interface.php" method="GET">
<input type="date" name="date" placeholder="Date processed?"><br><br>

<?php
$query1 = "SELECT Name FROM customers";
if($result = $mysqli->query($query1)) {
   require 'connection.php';
   if(isset($_GET['c_name'])) {
      $custName = $_GET['c_name'];  } }
?>

<select name="c_name">
<option>Select a customer</option>
<?php foreach($result as $key => $value) {?>
  <option value="<?=$value['Name'];?>"><?=$value['Name'];?></option>
<?php }?> </select><br><br>

<?php
$query2 = "SELECT sa_id FROM salesassociate";
if($result = $mysqli2->query($query2)) {
   require 'connection.php';
   if(isset($_GET['assoc_id'])) {
      $assocID = $_GET['assoc_id'];  } }
?>

<select name="assoc_id">
<option>Select an associate ID</option>
<?php foreach($result as $key => $value) {?>
  <option value="<?=$value['sa_id'];?>"><?=$value['sa_id'];?></option>
<?php  }?> </select><br><br>

<?php
$query3 = "SELECT status FROM quote_statuses";
if($result = $mysqli2->query($query3)) {
   require 'connection.php';
   if(isset($_GET['q_status'])) {
      $status = $_GET['q_status'];  } }
?>

<select name="q_status">
<option>Select a quote status</option>
<?php foreach($result as $key => $value) {?>
  <option value="<?=$value['status'];?>"><?=$value['status'];?></option>
<?php }?> </select><br><br>

<input type="submit" name="submit" value="Submit">
</form>
</body>
</html>
