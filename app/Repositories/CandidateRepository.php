<?php

namespace App\Repositories;
use App\Position;
use App\Candidate;
use Illuminate\Support\Facades\Hash;

class CandidateRepository
{
    public function __construct(Position $position , Candidate $candidate)
    {
        $this->position = $position;
        $this->candidate = $candidate;
    }

    /**
     * Checking if the candidate is already exists
     * @param integer $student_id_number
     * @return boolean
     */
    public function alreadyExists(int $student_id_number) : bool
    {
        return (boolean) $this->candidate
                               ->where('student_id',$student_id_number)
                               ->exists();
    }

    /**
     * Create new candidate
     * @param array $information
     * @return Candidate
     */
    public function createCandidate(array $information) : Candidate
    {

        return $this->candidate->create($information);
        
    }

}
