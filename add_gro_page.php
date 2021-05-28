<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
<h1 class = "title">Grotrack</h1>
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
}
</style>
<body>

<?php

$conn = new mysqli("localhost:8889", "groperson", "gropassword", "groceries");
$query = "SELECT gro_name, gro_exp_date FROM your_groceries;";
$results = $conn -> query($query);
echo "<table border='1' class='mytable'>";
echo'<tr>';
echo "<td>" . '<b>Grocery Item</b>' . "</td>";
echo "<td>" . '<b>Expiration Date</b>' . "</td>";
echo'</tr>';
while($row = mysqli_fetch_assoc($results)) {
    echo'<tr>';
    echo "<td>" . $row['gro_name'] . "</td>";
    echo "<td>" . $row['gro_exp_date'] . "</td>";
    echo "</tr>";
}
echo "</table>";
?>  

</body>
</html>


<php?

