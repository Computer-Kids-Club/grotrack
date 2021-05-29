<?php

$conn = new mysqli("localhost:3306", "groperson", "gropassword", "groceries");
$id = $_GET["id"];

$result = $conn->query("SELECT amount FROM groceries WHERE id = '".$id."';");
$row = $result->fetch_assoc();

$amount  = $row['amount'];
$amount = $amount - 1;

if($amount > 0){
    $queryUp = $conn->prepare("UPDATE groceries SET amount = ? WHERE id = ?");
    $queryUp->bind_param("ss", $amount, $id);
    $queryUp->execute();
}
else {
    $queryDel = $conn->prepare("DELETE FROM groceries WHERE id = ?");
    $queryDel->bind_param("s", $id);
    $queryDel->execute();
}
header("Location: add_gro_page.php");

?>