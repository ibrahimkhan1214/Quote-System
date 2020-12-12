<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
</head>
<link rel="stylesheet" href="HQinterface.css">
<body>
<?php
$servername = 'courses';
$username   = 'z1782120';
$password   = '1997Oct05';
$database   = 'z1782120';
$mysqli = new mysqli($servername, $username, $password, $database); 

$q_id = (int)$_GET['q_id'];

$query = "DELETE FROM quote WHERE q_id = $q_id";

if ($result = $mysqli->query($query)) 
	$message = "Record deleted successfully.";
else 
	$message = "Error: " . $query . "<br>" . mysqli_error($mysqli);

echo "<br><div id = message>" . $message . "</div>";
?>
<html>
<body>
</br><div id = "logout"><a href="HQinterface.php">Return</a></div>
</body>
</html>