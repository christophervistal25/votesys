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
     * [Is there available position]
     * @return boolean [description]
     */
    public function isThereAnyPosition() : int
    {
        return $this->position->count();
    }


    /**
     * [Get the a specific position by it's PK id]
     * @param  int    $id      [description]
     * @param  array  $columns [description]
     * @return [type]          [description]
     */
    public function getPositionById(int $id,$columns = []) : Position
    {
      return $this->position->find($id,$columns);
    }

    /**
     * [Get the a specific position by it's name]
     * @param  string $name [description]
     * @return [type]       [description]
     */
    public function getPositionByName(string $name) : Position
    {
        return $this->position->where('name',$name)->first();
    }

    /**
     * [Checking if the position is already exists]
     * @param  string $name [description]
     * @return [type]       [description]
     */
    public function alreadyExists(string $name) :bool
    {
        return  $this->position
                     ->where('name',$name)
                     ->exists();
    }

    /**
     * [Is the number of candidates reach the maximum no. for a position]
     * @param  int     $id [description]
     * @return boolean     [description]
     */
    public function isPositionReachLimit(int $id)
    {
     //getting the no. of candidates in position
      $no_of_candidates = $this->candidateRepository
                                ->getNoOfCandidateByPositionId($id);

     //get the limit of the position and compare to the no.of candidates
      return  $no_of_candidates >= $this->getPositionById($id)->limit;
    }

    /**
     * []
     * @param  array  $columns [description]
     * @return [type]          [description]
     */
    public function getOnly(array $columns = [])
    {
        return $this->position->get($columns);
    }


    /**
     * [Create new position]
     * @param  array  $information [description]
     * @return [type]              [description]
     */
    public function createNewPosition(array $information) : Position
    {
         //remove all whitespace
         $information['name'] = str_replace(' ','',$information['name']);

         return $this->position->create($information);
    }


     /**
     * [Update a position]
     * @param  int    $id   [description]
     * @param  array  $info [description]
     * @return [type]       [description]
     */
    public function updatePosition(int $id , array $info) : bool
    {
      return $this->getPositionById($id)
                            ->update($info);
    }

     /**
      * [Check first if there's a position in database that the user request to delete]
      * @param  int    $id [description]
      * @return [type]     [description]
      */
    public function deletePosition(int $id)
    {

      if(!is_null($this->getPositionById($id,['id']))) {
          return $this->position->destroy($id);
      }

    }


}
