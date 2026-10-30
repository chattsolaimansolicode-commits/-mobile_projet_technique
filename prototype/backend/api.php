<?php

header("Content-Type: application/json");

require_once "Property.php";

$file = "data.json";

$Properties = json_decode(file_get_contents($file), true);


// GET → show all Properties
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    echo json_encode($Properties);
    exit;
}


// POST → add a Property
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data = json_decode(file_get_contents("php://input"), true);

    $id = count($Properties) + 1;

    $property = new Property(
        $id,
        $data["name"],
        $data["description"]
    );

    $Properties[] = [
        "id" => $property->id,
        "name" => $property->name,
        "description" => $property->description
    ];

    file_put_contents(
        $file,
        json_encode($Properties, JSON_PRETTY_PRINT)
    );

    echo json_encode($property);
}
?>
