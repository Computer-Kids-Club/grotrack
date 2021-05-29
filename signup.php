<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $data = json_decode(file_get_contents('php://input'), true);

    $host = "localhost:3306";
    $conn = new mysqli($host, "groperson", "gropassword", "groceries");

    $uuid = uniqid("GRO-");
    
    $success = false;

    if($data['name']) {

        $query = "INSERT INTO `users` (`id`, `name`, `uuid`) VALUES (NULL, '". $data['name'] ."', '". $uuid ."');";
        
        $results = $conn -> query($query);

        if($results) {
            $success = true;
        }
    }

    $result = array('success' => $success, 'uuid' => $uuid);

    header('Content-type: application/json');
    echo json_encode($result);

} else {
    header("Location: /");
}

?>  