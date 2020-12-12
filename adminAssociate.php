<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Administrator Interface</title>
    <link rel="stylesheet" href="associate.css">
</head>

<style>
body {
    margin: 0;
    padding: 0;
    font-family: sans-serif;
    background: lightyellow;
}
</style>
    
<body>
    <center>
<h2>Associate Information</h2>
    
<?php 
    $servername = 'courses';
    $username   = 'z1782120';
    $password   = '1997Oct05';
    $database   = 'z1782120';
    $mysqli = new mysqli($servername, $username, $password, $database); 
    //Connection check
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $query = "SELECT * FROM salesassociate ORDER BY sa_id ASC";

    //Table Styling
    echo '<style>
    table {
        background-color: white;
    }
    </style>';
    echo '<table border="1 solid black" cellspacing="2" cellpadding="2"> 
          <tr> 
              <td> <font face="Arial">Associate ID</font> </td> 
              <td> <font face="Arial">Name</font> </td> 
              <td> <font face="Arial">Password</font> </td> 
              <td> <font face="Arial">Accumulated Commission</font> </td> 
              <td> <font face="Arial">Address</font> </td> 
          </tr>';


    //Button
    if(isset($_POST['viewTable'])) {
        
        if ($result = $mysqli->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $sa_id = $row["sa_id"];
                $name = $row["name"];
                $password = $row["password"];
                $commission = $row["commission"];
                $address = $row["address"];

                echo '<tr> 
                          <td>'.$sa_id.'</td> 
                          <td>'.$name.'</td> 
                          <td>'.$password.'</td> 
                          <td>'.$commission.'</td>
                          <td>'.$address.'</td> 
                          <td><a href="adminEditAssociate.php?sa_id='.$row['sa_id'].'">Edit</a></td>
                          <td><a href="adminAssociate.php?deleteRow='.$row['sa_id'].'">Delete</a></td>
                      </tr>';
            }
            $result->free();
        }
    }
    
    if(isset($_POST['hideTable'])) {

   }
    
    if(isset($_GET['deleteRow']) and is_numeric($_GET['deleteRow'])) {
        $delete = $_GET['deleteRow'];
        $sql = "DELETE FROM salesassociate WHERE sa_id = '$delete'";
        if ($mysqli->query($sql) === TRUE) {
          echo "Record successfully deleted<br>";
        } else {
          echo "Error: " . $sql . "<br>" . $mysqli->error. "<br>";
        }
   }
    
?>
  
<form method="post"> 
    <input type="submit" name="viewTable" value="View Table"/> 
    </form>
<form method="post"> 
    <input type="submit" name="hideTable" value="Hide Table"/> 
    </form><br>
<form method="post" action="adminAddAssociate.php"> 
    <input type="submit" name="addAssociate" value="Add Associate"/> 
    </form><br>
<form method="post" action="adminRedirect.php">
    <input type="submit" name="back" value="Back to Menu"/>
    </form>
    
  </center>
</body>
</html>