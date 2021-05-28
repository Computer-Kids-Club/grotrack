<!DOCTYPE html>
<html>
<style type="text/css">
        table.mytable {
            border: 1px solid Green;
        }
        table.mytable > thead > tr > th {
            font-size: 2em;
        }
        table.mytable > tbody > tr > td {
            color: Black;
        }
        table.mytable{
            margin-left: auto;
            margin-right: auto;
}
</style>
<body>

<?php

echo 'Hi this is add gro page';
$conn = new mysqli("localhost:3306", "groperson", "gropassword", "groceries");
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

