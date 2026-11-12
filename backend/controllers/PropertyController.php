<?php

require_once __DIR__ . '/../services/PropertyService.php';

class PropertyController
{
    private $propertyService;

    public function __construct()
    {
        $this->propertyService = new PropertyService();
    }

    public function index()
    {
        return $this->propertyService->getAll();
    }

    public function store()
    {
        $raw = file_get_contents('php://input');
        $payload = json_decode($raw, true);

        $property = $this->propertyService->add($payload['name'], $payload['description']);

        return [
            'id' => $property->getId(),
            'name' => $property->getName(),
            'description' => $property->getDescription()
        ];
    }
}