<!DOCTYPE html>
<html>
<body>

<?php

echo 'Hi this is add gro page';
$conn = new mysqli("localhost:3306", "groperson", "gropassword", "groceries");
$query = "SELECT gro_name, gro_exp_date FROM your_groceries;";
$results = $conn -> query($query);
echo "<table border='1'>";
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

