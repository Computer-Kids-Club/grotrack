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
//$uuid = ???
//$query = "SELECT groceries.name, groceries.exp_date FROM groceries INNER JOIN users ON groceries.user_id = users.id WHERE users.uuid = '".$uuid';";
$query = "SELECT id, name, amount, exp_date FROM groceries;";
$results = $conn -> query($query);
echo "<table class = 'has-text-centered has-background-success-light mytable'>";
echo "<tr>";
echo "<td>" . '<div class = "is-size-3 mx-3"> Grocery Item </div>' . "</td>";
echo "<td>" . '<div class = "is-size-3 mx-3"> Amount </div>' . "</td>";
echo "<td>" . '<div class = "is-size-3 mx-3"> Expiration Date </div>' . "</td>";
echo "<td>" . '<div class = "is-size-3"> Consume <div>' . "</td>";
echo "</tr>";
while($row = mysqli_fetch_assoc($results)) {
    echo"<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['amount'] . "</td>";
    echo "<td>" . $row['exp_date'] . "</td>";
    echo "<td>" . '<form action="update_amount.php" method="get"><button name="id" value="'.$row['id'].'" class="button is-outlined is-small is-primary mb-1"> Consume </button></form>' . "</td>";
    echo "</tr>";
}
echo "</table>";
?>
<br/>
<p class="pl-6">Click <a href="barcode.php">here</a> to scan a new grocery product, or add one manually</p>
</body>
</html>


<!-- <php? -->

