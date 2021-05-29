<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    $success = $data['uuid'] === 'abc';

    $result = array('success' => $success);

    header('Content-type: application/json');
    echo json_encode($result);

} else {
    header("Location: /");
}

?>  