<?php

namespace App\Repositories;
use App\Position;
use App\Candidate;

class PositionRepository
{

    public $position;

    public function __construct(Position $position , CandidateRepository $candidateRepo)
    {
        $this->position = $position;
        $this->candidateRepository = $candidateRepo;
    }

    /**
     * Check if there's any position in DB
     * @return boolean [description]
     */
    public function isThereAnyPosition() : int
    {
        return $this->position->count();
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

    public function getPositionByName(string $name) : Position
    {
        return $this->position->where('name',$name)->first();
    }

    public function alreadyExists(string $name) :bool
    {
        return  $this->position
                     ->where('name',$name)
                     ->exists();
    }

    /**
     * Check if the number of candidates reach
     * the maximum for the position
     * @param integer $id
     * @return boolean
     */
    public function isPositionReachLimit(int $id)
    {
      $no_of_candidates = $this->candidateRepository
                                ->getNoOfCandidateByPositionId($id);
      return  $no_of_candidates >= $this->getPositionById($id)->limit;
    }

    /**
     * Create new position in the database
     * @param array $information
     * @return Position
     */
    public function createNewPosition(array $information) : Position
    {
         $information['name'] = str_replace(' ','',$information['name']);
         return $this->position->create($information);
    }


    /**
     * Update a position
     *
     * @param integer $id
     * @param array $info
     * @return boolean
     */
    public function updatePosition(int $id , array $info) : bool
    {
      return $this->getPositionById($id)
                            ->update($info);
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
