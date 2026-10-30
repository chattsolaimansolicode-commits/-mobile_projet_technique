<?php

header("Content-Type: application/json");

require_once "GestionController.php";

$controller = new GestionController(__DIR__ . "/data.json");


// GET → show all properties
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    echo json_encode($controller->getAll());
    exit;
}


// POST → add a property
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    // name must have at least 3 characters
    if (mb_strlen(trim($data["name"])) < 3) {
        http_response_code(400);
        echo json_encode(["error" => "Name must have at least 3 characters"]);
        exit;
    }

    $property = $controller->add($data);

    echo json_encode($property);
}