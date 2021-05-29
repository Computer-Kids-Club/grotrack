<?php

include 'session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    $success = false;

    $host = "localhost:3306";
    $conn = new mysqli($host, "groperson", "gropassword", "groceries");

    $query = "SELECT * FROM `users` WHERE `uuid` = '". $data['uuid'] ."';";
        
    $results = $conn -> query($query);

    if($results) {
        if($results->num_rows) {
            $success = true;
        }
    }

    $_SESSION["uuid"] = $data['uuid'];

    $result = array('success' => $success);

    header('Content-type: application/json');
    echo json_encode($result);

} else {
    header("Location: /");
}

?>  