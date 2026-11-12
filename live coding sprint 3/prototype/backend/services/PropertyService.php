<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/PropertyDAO.php';

class PropertyService extends BaseService
{
    private $propertyDAO;

    public function __construct()
    {
        $this->propertyDAO = new PropertyDAO();
    }

    public function getAll()
    {
        return $this->propertyDAO->getAll();
    }

    public function add($name, $description)
    {
        // name must have at least 3 characters
        if (mb_strlen(trim($name)) < 3) {
            throw new Exception("Name must have at least 3 characters");
        }

        return $this->propertyDAO->add($name, $description);
    }
}