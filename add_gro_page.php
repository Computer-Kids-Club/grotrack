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
    td {
        height: 50px; 
        width: 50px;
    }

    td {
        text-align: center; 
        vertical-align: middle;
    }

    .border {
        font-size: 1.6rem;
        place-items: center;
        border: 2px solid;
        padding: 0rem;
    }

    .full {
        border-image: linear-gradient(45deg, turquoise, greenyellow) 1;
    }
</style>
<body class = "has-background-success-light">
<script type="text/javascript">

let funcs = [];

window.onload = function() {
    for (var key in funcs) {
        try {
            funcs[key](); // run your function
        } catch(err) {
            console.error(err);
        }
    }
}

</script>
<?php include 'header.php';?>
<?php

$is_dec = False;
$temp = $_GET['sort_by'];
if(isset($_GET['sort_by']) && substr($_GET['sort_by'], -3) == "dec"){
    $is_dec = True;
    $temp = substr($_GET['sort_by'], 0, -3);
}

$sort_by = "name";
if(isset($_GET["sort_by"])){
    $sort_by = $temp;
}


$host = "localhost:3306";
if (!is_null($_SERVER["SERVER_NAME"]) && $_SERVER["SERVER_NAME"] ===  "www.grotrack.co") {    
    $host = "localhost:3306";
}
$conn = new mysqli($host, "groperson", "gropassword", "groceries");


$uuid = $session_uuid;
$query = "SELECT groceries.id, groceries.name, groceries.amount, groceries.exp_date, groceries.barcode FROM groceries INNER JOIN users ON groceries.user_id = users.id WHERE users.uuid = '".$uuid."' ORDER BY groceries.".$sort_by.";";
if($is_dec){
    $query = "SELECT groceries.id, groceries.name, groceries.amount, groceries.exp_date, groceries.barcode FROM groceries INNER JOIN users ON groceries.user_id = users.id WHERE users.uuid = '".$uuid."' ORDER BY groceries.".$sort_by." DESC;";
}
$results = $conn -> query($query);


$almost_expired = array();
$expired = array();


date_default_timezone_set('America/Toronto');
$date = date('Y-m-d H:i:s');


echo "<table class = 'has-text-centered has-background-success-light mytable'>";
echo "<tr>";
if($_GET['sort_by'] == 'name'){
    echo "<td>" . '<div class = "mx-3 mb-5"><form action="add_gro_page.php" method="get"><button name="sort_by" value="namedec" class ="button is-ghost is-large"><div class="is-size-3"> Grocery Item </div></button></form></div>' . "</td>";
}
else{
    echo "<td>" . '<div class = "mx-3 mb-5"><form action="add_gro_page.php" method="get"><button name="sort_by" value="name" class ="button is-ghost is-large"><div class="is-size-3"> Grocery Item </div></button></form></div>' . "</td>";
}
echo "<td>" . '<div class = "mx-3 mb-5"><button class ="button is-ghost is-large"><div class="is-size-3"> Preview Item </div></button></div>' . "</td>";
if($_GET['sort_by'] == 'exp_date'){
    echo "<td>" . '<div class = "mx-3 mb-5"><form action="add_gro_page.php" method="get"><button name="sort_by" value="exp_datedec" class ="button is-ghost is-large"><div class="is-size-3"> Expiration Date </div></button></form></div>' . "</td>";
}
else{
    echo "<td>" . '<div class = "mx-3 mb-5"><form action="add_gro_page.php" method="get"><button name="sort_by" value="exp_date" class ="button is-ghost is-large"><div class="is-size-3"> Expiration Date </div></button></form></div>' . "</td>";
}
if($_GET['sort_by'] == 'amount'){
    echo "<td>" . '<div class = "mx-3 mb-5"><form action="add_gro_page.php" method="get"><button name="sort_by" value="amountdec" class ="button is-ghost is-large"><div class="is-size-3"> Amount </div></button></form></div>' . "</td>";
}
else{
    echo "<td>" . '<div class = "mx-3 mb-5"><form action="add_gro_page.php" method="get"><button name="sort_by" value="amount" class ="button is-ghost is-large"><div class="is-size-3"> Amount </div></button></form></div>' . "</td>";
}
echo "<td>" . '<div class = "mx-3 mb-5"><button class ="button is-ghost is-large"><div class="is-size-3"> Consume </div></button></div>' . "</td>";
echo "</tr>";


while($row = mysqli_fetch_assoc($results)) {
    $date_diff = ((strtotime($row['exp_date']) - strtotime($date)))/86400;
    echo"<tr>";
    echo "<td style='text-align: center; vertical-align: middle;' class='is-size-4'>" . $row['name'] . "</td>";
    $barcode = $row['barcode'];
    $id = $row['id'];
    //$xml = file_get_contents("https://world.openfoodfacts.org/api/v0/product/$barcode.json");
    //$xml = json_decode($xml);
    //$image = urldecode($xml->product->image_front_small_url);
    //$imageData = base64_encode(file_get_contents($image));
    echo '<td><img id="img_'.$id.'" class="full border image my-2 has-img-centered" style="max-height: 128px; max-width: 128px;"></td>';
    ?><script type="text/javascript">

    funcs.push(() => {
        let barcode = "<?php echo $barcode; ?>";
        let id = "<?php echo $id; ?>";
        let img_obj = document.getElementById("img_" + id);

        let url = "https://world.openfoodfacts.org/api/v0/product/" + barcode + ".json";

        console.log(url);

        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.send();
        xhr.onload = function () {
            try {

                //console.log("Got Response!");
                //console.log("Response: " + xhr.responseText);

                var response_obj = JSON.parse(xhr.responseText);

                //console.log(response_obj.product.image_front_small_url);

                if(response_obj.product.image_front_small_url) {
                    img_obj.src = response_obj.product.image_front_small_url;
                } else {
                    img_obj.src = "/carrot.png";
                }

            } catch(err) {
                console.error(err);
                img_obj.src = "/carrot.png";
            }
        };

        img_obj.src = "/carrot.png";
    });

    </script><?php
    if($date_diff <= 1 && $date_diff > 0){
        echo "<td style='text-align: center; vertical-align: middle;' class='has-text-warning is-size-4'>" . $row['exp_date'] . "</td>";
    }
    elseif($date_diff <= 0){
        echo "<td style='text-align: center; vertical-align: middle;' class='has-text-danger is-size-4'>" . $row['exp_date'] . "</td>";
    }
    else{
        echo "<td style='text-align: center; vertical-align: middle;' class='has-text-success is-size-4'>" . $row['exp_date'] . "</td>";
    }
    echo "<td style='text-align: center; vertical-align: middle;' class='is-size-4' class='is-size-4'>" . $row['amount'] . "</td>";
    echo "<td style='text-align: center; vertical-align: middle;'>" . '<form action="update_amount.php" method="get"><button name="id" value="'.$row['id'].'" class="button is-outlined is-medium is-primary mb-1"> Consume </button></form>' . "</td>";
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

</body>
</html>


<!-- <php? -->

