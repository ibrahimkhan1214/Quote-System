<!DOCTYPE HTML>  
<html>
<head>
    <meta charset="UTF-8">
    <title>Administrator Add Associate</title>
    <link rel="stylesheet" href="associate.css">
<style>

</style>
</head>
<body>  
<center>

<?php
    //Connection
    $servername = 'courses';
    $username   = 'z1782120';
    $password   = '1997Oct05';
    $database   = 'z1782120';
    $mysqli = new mysqli($servername, $username, $password, $database); 
    //Connection check
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    
    
    // define variables and set to empty values
    $nameErr = $userIDErr = $passwordErr = $commissionErr = $addressErr = "";
    $name = $userID = $password = $commission = $address = "";

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["name"])) {
        $nameErr = "Name entry blank";
      } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
          $nameErr = "Only letters and white space allowed";
        }
      }

      if (empty($_POST["password"])) {
        $passwordErr = "Password entry";
      } else {
        $password = test_input($_POST["password"]);
      }

      if (empty($_POST["commission"])) {
        $commission = "";
      } else {
        $commission = test_input($_POST["commission"]);
        // check for numbers only
        if (!preg_match("/^[0-9 ]*$/",$commission)) {
          $commissionErr = "Only numbers allowed";
          $commission = "";
        }
      }

      if (empty($_POST["address"])) {
        $addressErr = "Address entry blank";
      } else {
        $address = test_input($_POST["address"]);
      }
    }

    //optional code included: validation security layer.
    //Removes easy / hack exploit for php
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    
    if(isset($_POST['submit'])) {
    //    $sa_id = $_POST["userID"];
        $name = $_POST["name"];
        $password = $_POST["password"];
        $commission = $_POST["commission"];
        $address = $_POST["address"];
        $sql = "INSERT INTO salesassociate (name, password, commission, address)
            VALUES ('$name', '$password', '$commission', '$address')";

        if ($mysqli->query($sql) === TRUE) {
          echo "New record created successfully";
        } else {
          echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
   }
$mysqli->close();
?>

<div class="a">
<h2>Add Associate to Table</h2>
<form method="post">
    <div class="b">
      Name: <input type="text" name="name" value="<?php echo $name;?>">
      <br><br>
      Password: <input type="text" name="password" value="<?php echo $password;?>">
      <br><br>
      Commission: <input type="text" name="commission" value="<?php echo $commission;?>">
      <br><br>
      Address: <input type="text" name="address" value="<?php echo $address;?>">
      <br><br>
    </div>
<br><input type="submit" name="submit" value="Submit">  
</form>
<form method="post" action="adminAssociate.php">
    <input type="submit" name="back" value="Back"/>
    </form>
</div>
</center>
</body>
</html>
