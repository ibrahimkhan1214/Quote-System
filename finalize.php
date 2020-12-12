<?php
$servername = 'blitz.cs.niu.edu';
$username   = 'student';
$password   = 'student';
$dbname     = 'csci467';
$servername1 = 'courses';
$username1   = 'z1782120';
$password1   = '1997Oct05';
$dbname1     = 'z1782120';

$connection = mysqli_connect($servername, $username, $password, $dbname);
if(!$connection)
{
die('could not connect to database').mysql_error();
}
$connection1 = mysqli_connect($servername1, $username1, $password1, $dbname1);
if(!$connection1)
{
die('could not connect to database').mysql_error();
}


$select = "SELECT q_id FROM quote WHERE isfinal = 0";
$result = mysqli_query($connection1,$select);


$s_qid = $_POST['quote_id'];

$selectall = "SELECT q_id, date, customer_name, price,discount, email, description, secret_notes FROM quote WHERE q_id = '$s_qid'";
$resultall = mysqli_query($connection1,$selectall);
$arrall = mysqli_fetch_assoc($resultall);

$quo = $arrall['q_id'];
$Date = $arrall['date'];
$customer_name = $arrall['customer_name'];
$Discount = $arrall['discount'];
$Email = $arrall['email'];
$Description = $arrall['description'];
$Secret = $arrall['secret_notes'];
$Price = $arrall['price'];



if(isset($_POST['submit']))
{
$s_qid = $_POST['quote_id'];
$quo = $arrall['q_id'];
$Date = $arrall['date'];
$customer_name = $arrall['customer_name'];
$Discount = $arrall['discount'];
$Email = $arrall['email'];
$Description = $arrall['description'];
$Secret = $arrall['secret_notes'];
$Price = $arrall['price'];
}

?>
<!DOCTYPE>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="finalizequote.css">
</head>
<body>

<a href="salesassociate.php"><button class="back">Back</button></a>
<center>
<form action="finalize.php" method ="POST">
<select name="quote_id" class="drop">
    <option>Select Quote ID</option>
    <?php foreach($result as $key => $value)
    {?>
       <option value="<?=$value['q_id'];?>"><?=$value['q_id'];?></option>

       <?php }?>
</select>
<input type="submit" class="search"  name="submit" palceholder="search" value="Search"></input>

<table>
<tr><td><label>Quote ID</label><td>
<td><input type="text" class="Q_id"  name="Q_id" value=<?php echo $quo ?> ></input><td>
<tr>

<tr>
<td><label>Date Processed</label><td>
<td><input type="text" class="Date" name="Date" value=<?php echo $Date ?> ></input><td>
<tr>
<tr>
<td><label>Customer Name</label><td>
<td><input type="text" class="customer_name"  name="customer_name" value=<?php echo $customer_name ?> ></input><td>
<tr>
<tr>
<td><label>Price</label><td>
<td><input type="text" class="Price"  name="Price" value=<?php echo $Price ?> ></input><td>
<tr>
<tr>
<td><label>Discount</label><td>
<td><input type="text" class="Discount"  name="Discount" value=<?php echo $Discount ?> ></input><td>
<tr>
<tr>
<td><label>Email</label><td>
<td><input type="text" class="Email"  name="Email" value=<?php echo $Email ?> ></input><td>
<tr>
<tr>
<td><label>Description</label><td>
<td><textarea name="Description" class="Description"  rows=5 cols=40  value=<?php echo $Description ?> ></textarea><td>
<tr>
<tr>
<td><label>Secret</label><td>
<td><textarea name="Secret" class="Secret"  rows=5 cols=40 value=<?php echo $Secret ?> ></textarea><td>
<tr>
<tr>
<td><label>Price</label><td>
<td><input type="text" class="Price"  name="Price" value=<?php echo $Price ?> ></input><td>
<tr>
</table>
<input type="submit" class="finalize" name="finalize" palceholder="finalize" value="Finalize" ></input>

</form>
</center>
</body>
</html>

</body>

<?php


if(isset($_POST['finalize']))
{

$s_qid = $_POST['Q_id'];
$Date = $_POST['Date'];
$customer_name = $_POST['customer_name'];
$Discount = $_POST['Discount'];
$Email = $_POST['Email'];
$Description = $_POST['Description'];
$Secret = $_POST['Secret'];
$Price = $_POST['Price'];
$isFinal = 1;

$select1 = "UPDATE quote SET isfinal = '$isFinal', price = '$Price', description = '$Description', discount = '$Discount', email = '$Email', customer_name = '$customer_name', date = '$Date', secret_notes = '$Secret' WHERE q_id = '$s_qid'";
$result1 = mysqli_query($connection1,$select1);

if($result1)
{
echo "QUOTE TABLE UPDATED";
}
else
{
echo "FAILED TO UPDATE QUOTE TABLE";
}



}

?>
