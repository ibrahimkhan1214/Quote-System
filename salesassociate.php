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

$select2 = "SELECT sa_id FROM salesassociate";
$result2 = mysqli_query($connection1,$select2);
$message2 = "";

$select = "SELECT name FROM customers";
$result = mysqli_query($connection,$select);
$message = "";
if(isset($_POST['submit']))
{
    require 'connection.php';
    $date = $_POST['date'];
    $customerName = $_POST['C_name'];
    $price = $_POST['price'];
    $email = $_POST['email'];
    $description = $_POST['description'];
    $secret = $_POST['secret'];
    $S_id = $_POST['S_id'];
    $company_id_sql = "SELECT id FROM customers WHERE name = '$customerName'";
    $result_c_id = mysqli_query($connection,$company_id_sql);
    $nn = mysqli_fetch_assoc($result_c_id);

    $sql = "INSERT into quote (date, saoc_id, c_id, customer_name, price, email, description,secret_notes) VALUES ('$date', '$S_id', '$nn[id]','$customerName', '$price', '$email', '$description', '$secret');";
    if (mysqli_query($connection1, $sql)){
        $message = "New record created successfully";
    } else {
        $message = "Error" . $sql . "<br>" . mysqli_error($connection1);
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Associate page</title>
<link rel="stylesheet" href="salesassoc.css">
</head>

<body>
<center><h1>Create Quotes</h1></center>
<a href="login.php"><button class="back">Log Out</button></a>
<br>
<a href="finalize.php?q_id=1"><button class="edit">Finalize</button></a>
<hr size=3 noshade="" color=#31326f>
<h3><?=$message;?></h3>
<br>
<center>
<form class="assoc_form" action="salesassociate.php" method ="POST">
    <table>
    <tr>
       <td>
    <label><strong>Associate ID</strong></label>
       <td>
       <td>
    <select class="assoc_id"  name="S_id" required>
       <option value="">select your id</option>
       <?php foreach($result2 as $key => $value2)
       {?>
          <option class="list" value="<?=$value2['sa_id'];?>"><?=$value2['sa_id'];?></option>
          <?php }?>
       </select>
       <td>
    <tr>
    <tr>
       <td>
    <label><strong>Date processed</strong></label>
       <td>
       <td>
    <input class="date" type="date" name="date" placeholder="Date Processed?" required="required"/>
       <td>
    <tr>

    <tr>
       <td>
    <label><strong>Select Client Company</strong></label>
       <td>
       <td>
 <select class="client" name="C_name">
    <option>select client</option>
    <?php foreach($result as $key => $value)
    {?>
       <option value="<?=$value['name'];?>"><?=$value['name'];?></option>

       <?php }?>

    </select>
       <td>

    <tr>

    <tr>
       <td>
    <label><strong>Quote Price</strong></label>
       <td>
       <td>
    <input class="price" type="text" name="price" placeholder="Price" required="required"/>
       <td>
    <tr>
    <tr>
       <td>
    <label><strong>Email</strong></label>
       <td>
       <td>
    <input class="email" type="text" name="email" placeholder="Customer Email" required="required"/>
       <td>

    <tr>
</table>
    <hr size=3 noshade="" color=#31326f>
    <label><strong>Description</strong></label>
    <br>
    <textarea class="desc" id="description" name="description" rows=5 cols=50></textarea>
    <br>
    <label><strong>Secret Notes</strong></label><br>
    <textarea class="secret" id="secret_text" name="secret" rows=5 cols=50></textarea>
    <br>
    <input class="submit" type="submit" name="submit" value="submit">



</form>
</center>
</body>
</html>

