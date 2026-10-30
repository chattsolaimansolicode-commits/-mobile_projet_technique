<?php

require_once "Property.php";

class GestionController
{
    public function __construct(
        private string $file
    ) {}

    // return all properties
    public function getAll(): array
    {
        return json_decode(file_get_contents($this->file), true);
    }

    // add a property and return it
    public function add(array $data): Property
    {
        $properties = $this->getAll();

        $id = count($properties) + 1;

        $property = new Property(
            $id,
            $data["name"],
            $data["description"]
        );

        $properties[] = [
            "id" => $property->id,
            "name" => $property->name,
            "description" => $property->description
        ];

        file_put_contents(
            $this->file,
            json_encode($properties, JSON_PRETTY_PRINT)
        );

        return $property;
    }
}