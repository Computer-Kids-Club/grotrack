<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
<!-- <h1 class='has-background-success-light is-size-1 pl-6'>Grotrack</h1>
<style type="text/css">
        table.mytable {
            border: 1px solid Green;
        }
        table.mytable > thead > tr > th {
            font-size: 2em;
        }
        table.mytable > tbody > tr > td {
            color: Black;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
        }
        table.mytable{
            margin-left: auto;
            margin-right: auto;
        }
        h1.title {
            font-family: Arial, Helvetica, sans-serif;
            color: Green

        }

</style> -->
<style type="text/css">

    table.mytable {
        margin-left: auto;
        margin-right: auto;
    }
</style>
<body class = "has-background-success-light">
<?php include 'header.php';?>
<?php

$host = "localhost:3306";
if (!is_null($_SERVER["SERVER_NAME"]) && $_SERVER["SERVER_NAME"] ===  "www.grotrack.co") {    
    $host = "localhost:3306";
}
$conn = new mysqli($host, "groperson", "gropassword", "groceries");
$uuid = $session_uuid;
$query = "SELECT groceries.id, groceries.name, groceries.amount, groceries.exp_date FROM groceries INNER JOIN users ON groceries.user_id = users.id WHERE users.uuid = '".$uuid."';";
$results = $conn -> query($query);
$almost_expired = array();
$expired = array();
date_default_timezone_set('America/Toronto');
$date = date('Y-m-d H:i:s');
echo "<table class = 'has-text-centered has-background-success-light mytable'>";
echo "<tr>";
echo "<td>" . '<div class = "is-size-3 mx-3"> Grocery Item </div>' . "</td>";
echo "<td>" . '<div class = "is-size-3 mx-3"> Amount </div>' . "</td>";
echo "<td>" . '<div class = "is-size-3 mx-3"> Expiration Date </div>' . "</td>";
echo "<td>" . '<div class = "is-size-3"> Consume <div>' . "</td>";
echo "</tr>";
while($row = mysqli_fetch_assoc($results)) {
    $date_diff = ((strtotime($row['exp_date']) - strtotime($date)))/86400;
    echo"<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['amount'] . "</td>";
    if($date_diff <= 1 && $date_diff > 0){
        echo "<td class='has-text-warning'>" . $row['exp_date'] . "</td>";
    }
    elseif($date_diff <= 0){
        echo "<td class='has-text-danger'>" . $row['exp_date'] . "</td>";
    }
    else{
        echo "<td class='has-text-success'>" . $row['exp_date'] . "</td>";
    }
    echo "<td>" . '<form action="update_amount.php" method="get"><button name="id" value="'.$row['id'].'" class="button is-outlined is-small is-primary mb-1"> Consume </button></form>' . "</td>";
    echo "</tr>";
    if($date_diff <= 1 && $date_diff > 0){
        array_push($almost_expired, $row['exp_date']);
    }
    elseif($date_diff <= 0){
        array_push($expired, $row['exp_date']);
    }
}
echo "</table>";
$num_expiring = sizeof($almost_expired);
$num_expired = sizeof($expired);
if($num_expiring == 1 && !$_GET['no_msg']){
    if($num_expired == 1){
        echo "<script type='text/javascript'>alert('You have $num_expiring grocery product expiring! You have $num_expired expired grocery product!');</script>";
    }
    else if($num_expired > 1){
        echo "<script type='text/javascript'>alert('You have $num_expiring grocery product expiring! You have $num_expired expired grocery products!');</script>";
    }
    else{
        echo "<script type='text/javascript'>alert('You have $num_expiring grocery product expiring!');</script>";
    }
}
else if($num_expiring > 1 && !$_GET['no_msg']){
    if($num_expired == 1){
        echo "<script type='text/javascript'>alert('You have $num_expiring grocery products expiring! You have $num_expired expired grocer prodcut!');</script>";
    }
    else if($num_expired > 1){
        echo "<script type='text/javascript'>alert('You have $num_expiring grocery products expiring! You have $num_expired expired grocer prodcuts!');</script>";
    }
    else{
        echo "<script type='text/javascript'>alert('You have $num_expiring grocery products expiring!');</script>";
    }
}
else{
    if($num_expired == 1 && !$_GET['no_msg']){
        echo "<script type='text/javascript'>alert('You have $num_expired grocery product expired!');</script>";
    }
    else if($num_expired > 1 && !$_GET['no_msg']){
        echo "<script type='text/javascript'>alert('You have $num_expired grocery products expired!');</script>";
    }
}
?>

</body>
</html>


<!-- <php? -->

