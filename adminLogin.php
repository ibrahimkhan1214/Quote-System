<?php
include("loginserv.php"); //Include loginserv for checking username and password
include("pswrds.php");
include("connection.php");
?>

<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="a_login.css">
  </head>
    
<?php
if(isset($_POST['submit']))
{
$id = $_POST['username'];
}
?>
    
  <body class="login">

    <center>
    <form class="form" action="adminLogin.php" method="POST">
    <label><h1>Administrator Login</h1></label>
    <input class="user" type="text" placeholder="Username" name="username"><br/><br/>
    <input class="pass" type="password" placeholder="Password" name="password"><br/><br/>
    <input class="sub" type="submit" value="Login" name="submit"><br>
    <a href="index.php" >Back to Portal</a>
    </form>  
    </center>
   </body>
</html>

<?php
session_start();
include("pswrds.php");
include("connection.php");

if(isset($_POST['submit']))
{
   try{
      $userid = $_POST['username'];
      $password = $_POST['password'];
      //checking if the user exists
      $sql = "SELECT * FROM admin_users WHERE username = '$userid' AND password = '$password'";
      $rs = $pdo1->prepare($sql);
      //error checking and stopping the program
      if(!$rs) {
          echo "There was an error in query!!!";
          die();   
      }
      //executing the query
      $rs->execute(array($_POST["username"],$_POST["password"]));
      //getting all the data from the result set
      $rows = $rs->fetch(PDO::FETCH_ASSOC);

      if(!$rows) {
         echo '<script>alert("Invalid Username or Password.")</script>';  
      }
      else  header("location:adminRedirect.php");
   }
   catch(PDOexception $e) {
      echo "Connection Failed: ".$e->getMessage(); 
   }   
}
?>
