<?php

namespace App\Repositories;
use App\Position;

class PositionRepository
{

    public function __construct(Position $position)
    {
        $this->position = $position;
    }


    /**
     * Get the information of the position by id
     * @param integer $id
     * @return Position
     */
    public function getPositionById(int $id) : Position
    {
      return $this->position->find($id);
    }

    
    /**
     * Check if the position is already in the database find by name
     * @param string $position
     * @return boolean
     */
    public function alreadyExists(string $position) :bool
    {
      $trimmed = str_replace(' ', '', $position);
      return  $this->position->where('name',$trimmed)->exists();
    }

    /**
     * Create new position in the database
     * @param array $information
     * @return Position
     */
    public function createNewPosition(array $information) : Position
    {
      return $this->position->create([
            'name' => $information['position'],
            'limit' => $information['limit'],
        ]);
    }


     /**
      * Check if the position is in the database if so delete it
      * @param integer $id
      * @return void
      */
    public function deletePosition(int $id)
    {
      
      if(!is_null($this->getPositionById($id))) {
          return $this->position->destroy($id);
      }
      
    }


}
