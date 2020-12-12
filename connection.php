<?php
try
{
  $dsn1 = "mysql:host=courses;dbname=z1782120";   //connecting to the database
  include("pswrds.php");          //using password file
  $pdo1 = new PDO($dsn1, $username1, $password1);   //stating username and password
}

//handle the error if there is an errors and display the error code and info
catch(PDOexception $exception1)
{
  echo "Database connection failed: " . $exception1->getMessage();  //throw an error
}


try
{
  $connection2 = "mysql:host=blitz.cs.niu.edu;dbname=csci467";  //connecting to the second database
  include("pswrds.php");            //using password file
  $pdo2 = new PDO($connection2, $username2, $password2);      //stating username and password
}

// Error hadnling if there is one, display the error
catch(PDOexception $exception2)
{
  echo "Database connection failed: " . $exception2->getMessage();    //throw an error
}
?>

