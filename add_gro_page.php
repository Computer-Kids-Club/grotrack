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
    img.has-img-centered{
        margin-left:auto;
        margin-right:auto;
    }
</style>
<body class = "has-background-success-light">
<?php include 'header.php';?>
<?php

$sort_by = "name";
if(isset($_GET["sort_by"])){
    $sort_by = $_GET["sort_by"];
}


$host = "localhost:3306";
if (!is_null($_SERVER["SERVER_NAME"]) && $_SERVER["SERVER_NAME"] ===  "www.grotrack.co") {    
    $host = "localhost:3306";
}
$conn = new mysqli($host, "groperson", "gropassword", "groceries");


$uuid = $session_uuid;
$query = "SELECT groceries.id, groceries.name, groceries.amount, groceries.exp_date, groceries.barcode FROM groceries INNER JOIN users ON groceries.user_id = users.id WHERE users.uuid = '".$uuid."' ORDER BY groceries.".$sort_by.";";
$results = $conn -> query($query);


$almost_expired = array();
$expired = array();


date_default_timezone_set('America/Toronto');
$date = date('Y-m-d H:i:s');


echo "<table class = 'has-text-centered has-background-success-light mytable'>";
echo "<tr>";
echo "<td>" . '<div class = "mx-3"><form action="add_gro_page.php" method="get"><button name="sort_by" value="name" class ="button is-ghost is-large"><div class="is-size-2"> Grocery Item </div></button></form></div>' . "</td>";
echo "<td>" . '<div class = "py-3 mx-3 is-size-2"> Preview Item <div>' . "</td>";
echo "<td>" . '<div class = "mx-3"><form action="add_gro_page.php" method="get"><button name="sort_by" value="exp_date" class ="button is-ghost is-large"><div class="is-size-2"> Expiration Date </div></button></form></div>' . "</td>";
echo "<td>" . '<div class = "mx-3"><form action="add_gro_page.php" method="get"><button name="sort_by" value="amount" class ="button is-ghost is-large"><div class="is-size-2"> Amount </div></button></form></div>' . "</td>";
echo "<td>" . '<div class = "py-3 mx-3 is-size-2"> Consume <div>' . "</td>";
echo "</tr>";


while($row = mysqli_fetch_assoc($results)) {
    $date_diff = ((strtotime($row['exp_date']) - strtotime($date)))/86400;
    echo"<tr>";
    echo "<td class='is-size-3'>" . $row['name'] . "</td>";
    $barcode = $row['barcode'];
    $xml = file_get_contents("https://world.openfoodfacts.org/api/v0/product/$barcode.json");
    $xml = json_decode($xml);
    $image = urldecode($xml->product->image_front_small_url);
    $imageData = base64_encode(file_get_contents($image));
    echo '<td><img class="image is-96x96 my-2 has-img-centered" src="data:image/jpeg;base64,'.$imageData.'" width=300vw></td>';
    if($date_diff <= 1 && $date_diff > 0){
        echo "<td class='has-text-warning is-size-3'>" . $row['exp_date'] . "</td>";
    }
    elseif($date_diff <= 0){
        echo "<td class='has-text-danger is-size-3'>" . $row['exp_date'] . "</td>";
    }
    else{
        echo "<td class='has-text-success is-size-3'>" . $row['exp_date'] . "</td>";
    }
    echo "<td class='is-size-3'>" . $row['amount'] . "</td>";
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


if($num_expiring == 1 && !$_GET['no_msg'] && !$_GET['sort_by']){
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
else if($num_expiring > 1 && !$_GET['no_msg'] && !$_GET['sort_by']){
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
    if($num_expired == 1 && !$_GET['no_msg'] && !$_GET['sort_by']){
        echo "<script type='text/javascript'>alert('You have $num_expired grocery product expired!');</script>";
    }
    else if($num_expired > 1 && !$_GET['no_msg'] && !$_GET['sort_by']){
        echo "<script type='text/javascript'>alert('You have $num_expired grocery products expired!');</script>";
    }
}
?>
<?php
// $xml = file_get_contents("https://world.openfoodfacts.org/api/v0/product/$barcode.json");
// $xml = json_decode($xml);
// $image = urldecode($xml->product->image_front_small_url);
// $imageData = base64_encode(file_get_contents($image));
// echo '<p style="float: left;"><img src="data:image/jpeg;base64,'.$imageData.'" width=300vw></p>';?>

</body>
</html>


<!-- <php? -->

