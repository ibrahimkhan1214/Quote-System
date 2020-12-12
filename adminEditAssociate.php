<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Administrator Edit Associate</title>
    <link rel="stylesheet" href="associate.css">
</head>

<body>
   <center>
<?php
$servername = 'courses';
$username   = 'z1782120';
$password   = '1997Oct05';
$database   = 'z1782120';
$mysqli = new mysqli($servername, $username, $password, $database); 

$sa_id = (int)$_GET['sa_id'];

$query = "SELECT * FROM salesassociate WHERE sa_id = $sa_id";

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $sa_id = $row['sa_id'];
        $name = $row['name'];
        $password = $row['password'];
        $commission = $row['commission'];
        $address = $row['address'];
	}
    }
else
	echo "No entry found for this sales associate ID";

if(isset($_POST['submit']))
{
	require 'connection.php';
	$sa_id = $_POST['sa_id'];
    $name = $_POST['name'];
	$password = $_POST['password'];
	$commission = $_POST['commission'];
    $address = $_POST['address'];

    $sql = "UPDATE salesassociate SET sa_id = '$sa_id', name = '$name', password = '$password', commission = '$commission', address =           '$address' WHERE sa_id = $sa_id;";

	if ($mysqli->query($sql) == TRUE) {
        $message = "Record edited successfully";
	} else {
        $message = "Error: " . $sql . "<br>" . mysqli_error($mysqli);
	}
	echo $message;
}
?>
<div class="a">
    <div class="b">
    <h2>Editing Sales Associate</h2>
    <form action="adminEditAssociate.php?sa_id=$sa_id" method="POST">
        <input type="hidden" id = "sa_id" name="sa_id" value="<?=$sa_id;?>">
        <table border="0" cellspacing="2" cellpadding="2">
        <tr> Sales Associate ID: <?php echo $sa_id; ?></tr><br>

            <tr> New Name: <input type="text" id="name" name="name" value="<?=$name?>"></tr><br>
            <tr> New Password: <input type="text" id="password" name="password" value="<?=$password?>"></tr><br>
            <tr> New Commission: <input type="text" id="commission" name="commission" value="<?=$commission?>"></tr><br>
            <tr> New Address: <input type="text" id="address" name="address" value="<?=$address?>"></tr><br>
        </table>
        <input type="Submit" name="submit" value="Submit">
        </form>
        <form method="post" action="adminAssociate.php">
        <input type="submit" name="back" value="Back"/>
        </form>
    </div>
</div> 
</center>
</body>
</html>