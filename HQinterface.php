<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Headquarters Interface</title>
</head>
<link rel="stylesheet" href="HQinterface.css">
<body>
<h2 class = "heading1"> Finalized Quotes </h2>
<?php 
$servername = 'courses';
$username   = 'z1782120';
$password   = '1997Oct05';
$database   = 'z1782120';
$mysqli = new mysqli($servername, $username, $password, $database); 

$query = "SELECT * FROM quote WHERE isfinal = 1";

echo '<div><table border="1" id = "quotes" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td> <font face="Arial">Quote ID</font> </td> 
		  <td> <font face="Arial">Date Entered</font> </td>
          <td> <font face="Arial">Customer Name</font> </td> 
          <td> <font face="Arial">Current Price</font> </td> 
          <td> <font face="Arial">Current Discount</font> </td> 
          <td> <font face="Arial">Client Email Address</font> </td> 
		  <td> <font face="Arial">Description</font> </td> 
		  <td> <font face="Arial">Hidden Notes</font> </td> 
		  <td> <font face="Arial">Status</font> </td> 
      </tr>';

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $q_id = $row["q_id"];
		$date = $row["date"];
        $customer_name = $row["customer_name"];
        $price = $row["price"];
		$discount = $row["discount"];
        $email = $row["email"];
        $description = $row["description"]; 
		$secret_notes = $row["secret_notes"]; 
		$status = $row["status"]; 

        echo '<tr> 
                  <td>'.$q_id.'</td> 
				  <td>'.$date.'</td> 
                  <td>'.$customer_name.'</td> 
                  <td>$'.$price.'</td> 
			      <td>$'.$discount.'</td>
                  <td>'.$email.'</td> 
                  <td>'.$description.'</td> 
				  <td>'.$secret_notes.'</td> 
				  <td>'.$status.'</td> 
				  <td><a href="edit_quote.php?q_id=' . $row['q_id'] . '">Edit</a></td>
				  <td><a href="delete_quote.php?q_id=' . $row['q_id'] . '">Delete</a></td>
			</tr>';
	}
	echo '</div><div id = "logout"><a href="HQlogin.php" >Log Out</a></div>';
	}
?>
</body>
</html>
