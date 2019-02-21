<?php

namespace App\Repositories;
use App\Candidate;
use App\Position;
use App\Student;
use Illuminate\Support\Facades\Hash;
use Exception;

class CandidateRepository
{
    public $candidate;

    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;
    }


    /**
     * [Fetch all candidates]
     * @return [type] [description]
     */
    public function getAllCandidates()
    {
        if ($this->isThereAnyCandidate() <= 0) {
            throw new Exception('There is no candidate.');
        }
        return $this->candidate->all();
    }

    /**
     * Check if there's any position in DB
     * @return no of candidates
     */
    public function isThereAnyCandidate() :int
    {
        return $this->candidate->count();
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
     * Get the no. of candidates
     *
     * @param integer $id
     * @return integer
     */
    public function getNoOfCandidateByPositionId(int $id) :int
    {
        $candidates = $this->candidate->where('position_id',$id);
        return (is_null($candidates) ? 0 : $candidates->get()->count());
    }

    /**
     * Get all candidates with votes
     * @return boolean
     */
    public function candidatesWithVote()
    {
        return $this->candidate
                     ->with(['studentInfo','votes'])
                     ->get();
    }

    /**
     * Get all candidate with information
     *
     * @return void
     */
    public function getCandidatesWithInfo()
    {
        return $this->candidate
                    ->with(['studentInfo','position'])
                    ->get();
    }

    /**
     * [Group the candidates by position]
     * @return [type] [description]
     */
    public function getCandidatesWithVotesForRank()
    {
        $candidates = $this->candidate
                            ->with(['studentInfo','position:id,name'])
                            ->has('votes')->withCount('votes')
                            ->orderBy('votes_count','DESC')
                            ->get(['student_id','position_id']);

        return $candidates->groupBy('position_id');

    }

    /**
     * Create new candidate
     * @param array $information
     * @return Candidate
     */
    public function createCandidate(array $information) : Candidate
    {
        $this->changeProfile($information);
        //check if set and override the profile name
        $information['profile'] = !empty($information['profile'])
        ? $information['profile']->getClientOriginalName() : 'no_image.png';
        return $this->candidate
                    ->create($information);
    }

    /**
     * [isAdminWantToChangeProfile if the admin want to change profile]
     * @param  [type]  $items [description]
     * @return boolean        [description]
     */
    private function changeProfile($items)
    {
        if (isset($items['profile'])) {
            $image = $items['profile']->getClientOriginalName();
            $items['profile']->move(base_path('/public/images'),$image);
        }
    }

}
