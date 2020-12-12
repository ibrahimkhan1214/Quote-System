<?php
include("loginserv.php"); // Include loginserv for checking username and password
include("pswrds.php");
include("connection.php");
?>
 
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="s_login.css">
</head>
<?php
if(isset($_POST['submit']))
{
$id = $_POST['userid'];
}
?>


<body class="login_body">

  <center>
<form class="form" action="login.php" method="POST">
<h1 class="login_heading">login</h1>
<input class="user" type="text" placeholder="SALES ID" name="userid"><br/><br/>
<input class="pass" type="password" placeholder="Password" name="password"><br/><br/>
<input class="sub" type="submit" value="Log In" name="submit"><br>
<a href="index.php" >Back to Portal</a>
<center>
</form>
</body>
</html>

<?php
session_start();
include("pswrds.php");
include("connection.php");

if(isset($_POST['submit']))
{

                try{
                        $userid = $_POST['userid'];
                        $password = $_POST['password'];
                        //checking if the user exists
                        $sql = "SELECT * FROM salesassociate WHERE sa_id = '$userid' AND password = '$password'";
                        $rs = $pdo1->prepare($sql);
                        // error checking and stopping the program
                        if(!$rs){ echo "There was an error in query!!!"; die();  }
                        // executing the equery
                        $rs->execute( array( $_POST["userid"], $_POST["password"] ));
                        // getting all the data from the result set
                        $rows = $rs->fetch(PDO::FETCH_ASSOC);

                        if(!$rows){
                                echo '<script> alert("Invalid Username or Password. If new user, please register") </script>';
                        }
                        else{
                                header("location:salesassociate.php");
                        }
                }
                catch(PDOexception $e){
                        echo "Connection Failed: ".$e->getMessage();
                }
}
?>

