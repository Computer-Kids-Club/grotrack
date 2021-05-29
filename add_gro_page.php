<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
<h1 class='has-background-success-light is-size-1 has-text-left ml-7'>Grotrack</h1>
<!-- <style type="text/css">
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
<body>
<div class = "has-background-success-light">
<?php

$host = "localhost:3306";
if (!is_null($_SERVER["SERVER_NAME"]) && $_SERVER["SERVER_NAME"] ===  "www.grotrack.co") {    
    $host = "localhost:3306";
}
$conn = new mysqli($host, "groperson", "gropassword", "groceries");
$query = "SELECT gro_name, gro_exp_date FROM your_groceries;";
$results = $conn -> query($query);
echo "<table class = 'has-text-centered has-background-success-light mytable'>";
echo "<tr>";
echo "<td>" . '<b class = "is-size-3 mx-3"> Grocery Item </b>' . "</td>";
echo "<td>" . '<b class = "is-size-3 mx-3"> Expiration Date </b>' . "</td>";
echo "</tr>";
while($row = mysqli_fetch_assoc($results)) {
    echo"<tr>";
    echo "<td>" . $row['gro_name'] . "</td>";
    echo "<td>" . $row['gro_exp_date'] . "</td>";
    echo "</tr>";
}
echo "</table>";
?>  
</div>
</body>
</html>


<!-- <php? -->

