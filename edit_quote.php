<?php
include("loginserv.php"); // Include loginserv for checking username and password
include("pswrds.php");
include("connection.php");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Quote Edit</title>
<link rel="stylesheet" href="HQinterface.css">
</head>
<?php
$servername = 'courses';
$username   = 'z1782120';
$password   = '1997Oct05';
$database   = 'z1782120';
$mysqli = new mysqli($servername, $username, $password, $database); 

$q_id = (int)$_GET['q_id'];

$query = "SELECT * FROM quote WHERE q_id = $q_id";

if ($result = $mysqli->query($query)) 
{
    while ($row = $result->fetch_assoc()) 
	{
        $q_id = $row["q_id"];
		$date = $row["date"];
		$saoc_id = $row["saoc_id"];
        $customer_name = $row["customer_name"];
		$email = $row["email"];
        $price = $row["price"];
		$discount = $row["discount"];
        $email = $row["email"];
        $description = $row["description"]; 
		$secret_notes = $row["secret_notes"]; 
		$status = $row["status"]; 
	}
}
else
	echo "No entry found for this quote ID";

if(isset($_POST['submit']))
{
	require 'connection.php';
	$q_id = $_POST['q_id'];
    $date = $_POST['date'];
	$saoc_id = $_POST['saoc_id'];
	$email = $_POST['email'];
    $customer_name = $_POST['customer_name'];
	$price = $_POST['price'];
	$description = $_POST['description']; 
	$secret_notes = $_POST['secret_notes'];
	
	$discount_type = $_POST['discount_type'];
	
	if ($discount_type == 1)
		$discount = $_POST['discount'];
	else
		$discount = $_POST['discount'] / 100 * $price;
	
	$sql = "UPDATE quote SET price = $price, discount = $discount, description = '$description', discount = $discount, 
			secret_notes = '$secret_notes' WHERE q_id = $q_id;";

	if ($mysqli->query($sql) == TRUE) 
		$message = "Record edited successfully";
	else 
		$message = "Error: " . $sql . "<br>" . mysqli_error($mysqli);

	echo "<br><div id = message>" .$message. "</div>";

	if(isset($_POST['status']))
	{
		$is_sanctioned = $_POST['status'];
			
		if($is_sanctioned == 1) 
		{
			$sql = "UPDATE quote SET status = 'SANCTIONED' WHERE q_id = $q_id;";
			$title = "Quote Information: " . $q_id;
			$msg = "Quote ID: ". $q_id . "<br>Customer Name: " . $customer_name . "<br>Customer Email: " . $email . "<br>Date Created: " . $date. 
					"<br>Sales Associate ID: " . $saoc_id. "<br>Price: " . $price. "<br>Discount: " . $discount	 . "<br>Description: " . $description;
			/*mail($email,$title, "Test");
			echo "<br><br>" . $msg . "<br><br>";*/
		}
		if ($mysqli->query($sql) == TRUE) 
		{
			$message = "Quote coverted into purchase order, and email has been sent to " . $email;
		}
		else 
			$message = "Error: " . $sql . "<br>" . mysqli_error($mysqli);

		echo "<br><div id = message>" .$message . "</div>";
	}
}
?>
<html>
<body>
<form action="edit_quote.php?q_id=$q_id" method="POST">
	<input type="hidden" id = "q_id" name="q_id" value="<?=$q_id;?>">
	<input type="hidden" id = "date" name="date" value="<?=$date;?>">
	<input type="hidden" id = "saoc_id" name="saoc_id" value="<?=$saoc_id;?>">
	<input type="hidden" id = "customer_name" name="customer_name" value="<?=$customer_name;?>">
	<input type="hidden" id = "email" name="email" value="<?=$email;?>">
	<table id = "edit_quote" border="0" cellspacing="2" cellpadding="2">
	<tr><td> Quote ID: <?php echo $q_id; ?></td></tr>
	<tr><td> Date Entered: <?php echo $date; ?></td></tr>
	<tr><td> Customer Name: <?php echo $customer_name; ?></td></tr>
	<tr><td> Customer Email: <?php echo $email; ?></td></tr>
	<tr>
		<td> Price: <input type="text" id="price" name="price" value="<?=$price?>"></td>
	</tr>
	<tr>
		<td> Discount: 
		<select name="discount_type" id="discount_type">
			<option value="1">Amount</option>
			<option value="0">Percent</option>
		</select>
		<input type="text" id="discount" name="discount" value="<?=$discount?>">
		</td>
	</tr>
	<tr>
		<td> Description: <input type="text" id="description" name="description" value="<?=$description?>"></td>
	</tr>
	<tr>
		<td> Hidden Notes: <input type="text" id="secret_notes" name="secret_notes" value="<?=$secret_notes?>"></td>
	</tr>
	<tr>
		<td> 
		<input type="checkbox" id="status" name="status" value=1> 
		<label for="status">Sanctioned</label>
		</td>
	</tr>
	<tr><td><input id = "submit_changes" type="Submit" name="submit" value="Submit"></td></tr>
	<tr><td><a href="HQinterface.php">Return</a></td></tr>
</form>
</body>
</html>