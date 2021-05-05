<?php
require_once(__DIR__ . "/classes/helpers/Database.php");

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$conn = (new Database())->createConnection();

if(isset($_GET['code'])) {   
    $sql = "SELECT code FROM tests WHERE code=?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$_GET['code']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(empty($user)){
        echo json_encode(array("code" => ""));
    }
    else {
        echo json_encode($user);
    }
} 
else {
    http_response_code(404);
    echo json_encode(array("message" => "Nenájdené."));
}
