<?php

require_once __DIR__ . '/../Property.php';
class PropertyDAO
{
    private $path;
    public function __ construct()

   {
      $this ->path = __DIR__ . '/../database/database.json';
   }
   public function getAll()
   {
    $data = file_get_contents($this->path);
    return json_decode($data, true);
   }
   public function add ($name, $description)
   {
        $data = $this->getAll();
        $id = count ($data) + 1;
        $property = new Property($id,$name,$description);
 
    $data [] = [
        'id'=> $property ->getId(),
        'name'=> $property ->getNAme(),
        'id'=> $property ->getDescription()

    ];
    file_put_contents($this->path, json_encode($data, JSON_PRETTY_PRINT));
    return $property;

   }


}