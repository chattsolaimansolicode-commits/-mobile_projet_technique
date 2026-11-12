<?php
   require_once __DIR__ .'/BaseService.php';
   require_once __DIR__ .'/PropertyDAO.php';
 
   class PropertyService extends BaseService
{
    private $propertyDAO;
    public function __ construc()

    {
        $this-> property DAO = new PropertyDAO();
    }
    public function getAll()
    {
        return $this->propertyDAO-> getAll();
    }
    public function add ($name, $description)
    {
        if (nb_strlen(trim($name))<3){
            throw newExeption("Name must have at least 3 characters");
        }
        return $this-> propertyDAO->add($name, $description);
    }


}
