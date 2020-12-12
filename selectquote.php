<?php
$servername = 'blitz.cs.niu.edu';
$username   = 'student';
$password   = 'student';
$dbname     = 'csci467';
$servername1 = 'courses';
$username1   = 'z1782120';
$password1   = '1997Oct05';
$dbname1     = 'z1782120';

$x = 1;

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

$select3 = "SELECT q_id FROM quote ORDER BY q_id DESC";
$result3 = mysqli_query($connection1,$select3);
$message3 = "";

if(isset($_POST['submit']))
{
require('connection.php');


$quo = $_POST['quote_id'];

}
?>
<!DOCTYPE>
<html>
<head>
<meta charset="UTF-8">
<title>Select Quote ID</title>
<link rel="stylesheet" href="selcquo.css">
</head>
<body>
<form action="processingsystem.php" method ="POST">
<br><br><br><br><br>
<div style="text-align:center;">
<label><strong>Select the Quote ID to Process the Order</strong></label>
</div>
<td>
<tr>
<select class="qt_id" name="quote_id">
    <option>Select Quote ID</option>
    <?php foreach($result3 as $key => $value)
    {?>
       <option value="<?=$value['q_id'];?>"><?=$value['q_id'];?></option>

       <?php }?>
</select>
<div style="text-align:center">
<input class="submit" type="submit" name="submit" placeholder="quote id" ></input>
<br><br><br><a href="homepage.php">Back to Portal</a>
</div>
<a href="processingsystem.php?id=$quo"></a>

</form>
</body>
</html>

