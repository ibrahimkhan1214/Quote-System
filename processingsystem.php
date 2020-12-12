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

$select3 = "SELECT q_id FROM quote";
$result3 = mysqli_query($connection1,$select3);
$message3 = "";

$quo = $_POST['quote_id'];

$select4 = "SELECT price FROM quote WHERE q_id = '$quo'";
$result4 = mysqli_query($connection1,$select4);
$quote_price = mysqli_fetch_assoc($result4);
$cc = $quote_price['price'];

$select5 = "SELECT saoc_id FROM quote WHERE q_id = '$quo'";
$result5 = mysqli_query($connection1, $select5);
$associate_id = mysqli_fetch_assoc($result5);

$select6 = "SELECT c_id FROM quote WHERE q_id  = '$quo'";
$result6 = mysqli_query($connection1, $select6);
$company_id = mysqli_fetch_assoc($result6);

$select7 = "SELECT email FROM quote WHERE q_id  = '$quo'";
$result7 = mysqli_query($connection1, $select7);
$contact_email = mysqli_fetch_assoc($result7);

$select8 = "SELECT discount FROM quote WHERE q_id  = '$quo'";
$result8 = mysqli_query($connection1, $select8);
$price_disc = mysqli_fetch_assoc($result8);


if(isset($_POST['find']))
{
$select4 = "SELECT price FROM quote WHERE q_id = '$quo'";
$result4 = mysqli_query($connection1,$select4);
$quote_price = mysqli_fetch_assoc($result4);
$cc = $quote_price['price'];

$select5 = "SELECT saoc_id FROM quote WHERE q_id = '$quo'";
$result5 = mysqli_query($connection1, $select5);
$associate_id = mysqli_fetch_assoc($result5);

$select6 = "SELECT c_id FROM quote WHERE q_id  = '$quo'";
$result6 = mysqli_query($connection1, $select6);
$company_id = mysqli_fetch_assoc($result6);

$select7 = "SELECT email FROM quote WHERE q_id  = '$quo'";
$result7 = mysqli_query($connection1, $select7);
$contact_email = mysqli_fetch_assoc($result7);

$select8 = "SELECT discount FROM quote WHERE q_id  = '$quo'";
$result8 = mysqli_query($connection1, $select8);
$price_disc = mysqli_fetch_assoc($result8);
}





?>

<!DOCTYPE html> 
<html> 
<head> 
<meta charset="UTF-8"> 
<title>Processing System</title>
<link rel="stylesheet" href="process.css">
</head>

<body> <h2> Select and Process a Quote </h2> <a

href="homepage.php">Return</a> 
<h3><?=$message3;?></h3> 

<form action="processingsystem.php" method ="POST">
<select name="quote_id">
    <option>Select Quote ID</option>
    <?php foreach($result3 as $key => $value)
    {?>
       <option value="<?=$value['q_id'];?>"><?=$value['q_id'];?></option>

       <?php }?>
</select>
<br>
<br>
<table>
<tr>
   <td>
      <label>Quote ID</label>
   <td>
   <td>
      <input type="text" name = "q_id" value= <?php echo $quo ?>>
   <td>
</tr>
<tr>
      <td>
         <label>Quote amount</label>
      <td>
      <td>
         <input type="text" name = "quote_amt" value=<?php echo $quote_price['price']?> >
      <td>
</tr>
<tr>
      <td>
         <label>associate id</label>
      <td>
      <td>
         <input type="text" name = "asso_id" value=<?php echo $associate_id['saoc_id']?>>
      <td>
</tr>
<tr>
      <td>
         <label>Company ID</label>
      <td>
      <td>
         <input type="text" name = "comp_id" value=<?php echo $company_id['c_id']?>>
      <td>
</tr>
<tr>
      <td>
         <label>Company Email</label>
      <td>
      <td>
         <input type="text" name = "comp_email" value=<?php echo $contact_email['email']?>>
      <td>
</tr>
<tr>
      <td>
         <br><input class="submit" type="submit" name="find" value="Find">
      <td>
</tr>
</table>
<br>
<hr size = "3" noshade="">
<br>
<table>
<tr>
      <td>
      <label>Previous discount</label>
      <td>
      <td>
      <input type="text" name = "prev_disc" value=<?php echo $price_disc['discount']?>>
      <td>
</tr>
<tr>
      <td>
      <label>additional discount</label>
      <td>
      <td>
      <input type="text" name = "add_disc" value="0.00">
      <td>
      <td>
         <select name="disc_type">
         <option>Percentage</option>
         <option>Dollar Amount</option>
      <td>

</tr>

<tr>
      <td>
         <br><input class=submit type="submit" name="confirm" value="Confirm">
      <td>
</tr>
</table>

</form>
</body>
</html>

<?php
if(isset($_POST['confirm']))
{
$prev_amount = $_POST['quote_amt'];
$add_disc = $_POST['add_disc'];
$previous = $_POST['prev_disc'];
$total_disc = $add_disc + $previous;

$calc_choice = $_POST['disc_type'];
switch($calc_choice)
{
   case "Percentage":
	$final_amount = $prev_amount - ((($prev_amount*$add_disc)/100)+ $previous);
	echo "This is the final amount sent to the processing system: ";
        echo $final_amount;
	break;
   case "Dollar Amount":
        $final_amount = $prev_amount - $total_disc;
        echo "This is the final amount sent to the processing system: ";
        echo $final_amount;
	break;
}

$quote = $_POST['q_id']; 
$a_id = $_POST['asso_id'];
$cu_id = $_POST['comp_id'];

$url = 'http://blitz.cs.niu.edu/PurchaseOrder/';
	$data = array(
	   'order' => $quote, 
	   'associate' => $a_id,
	   'custid' => $cu_id, 
	   'amount' => $final_amount);
		
	$options = array(
         'http' => array(
           'header' => array('Content-type: application/json', 'Accept: application/json'),
            'method'  => 'POST',
            'content' => json_encode($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
echo '<br><br>' . ($result);

$resultArray = json_decode($result, true);
$comm = $resultArray["commission"];
echo "<br><br>The Sales Associate commission has been updated in the database to: " . $comm;
$query1 = "UPDATE salesassociate SET commission = '$comm' where sa_id = $a_id";
$query_out1 = mysqli_query($connection1, $query1) or die ("Search query failed;" . mysqli_error($connection1));
//
$resultArray2 = json_decode($result, true);
$amo = $resultArray2["amount"];
echo "<br><br>The price after all the discounts has been updated in the database to: " . $amo;
$query22 = "UPDATE quote SET price = '$amo' where q_id = $quote";
$query_out22 = mysqli_query($connection1, $query22) or die ("Search query failed;" . mysqli_error($connection1));
//
$query33 = "UPDATE quote SET ordered = '1' where q_id = $quote";
$query_out33 = mysqli_query($connection1, $query33) or die("Search query failed;" . mysqli_error($connection1));
echo "<br><br>The status has been changed to 'Ordered' in the database";
//
$email_to = $_POST['comp_email'];
$subject = "Your Finalized Quote";
$message = "Finalized amount: $final_amount";

mail($email_to, $subject, $message);
if(mail($email_to, $subject, $message))
{
echo 'SUCCESS';
}
else
{
echo '<br><br>Email has been sent ';
echo 'Recepient: ';
echo $email_to;
echo '<br><br>';
echo $subject;
echo $message;
}
}
?>

