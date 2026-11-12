<?php

header("Content-Type: application/json");

require_once __DIR__ . '/controllers/PropertyController.php';

$controller = new PropertyController();

try {
    // GET → show all properties
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        echo json_encode($controller->index());
    }

    // POST → add a property
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        echo json_encode($controller->store());
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(["error" => $e->getMessage()]);
}