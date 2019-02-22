<?php

namespace App\Repositories;
use App\Candidate;
use App\Position;
use App\Repositories\PositionRepository;
use App\Student;
use Exception;
use Illuminate\Support\Facades\Hash;

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
    public function getAllCandidates(array $columns = [])
    {
        //checking if there's candidate
        if ($this->isThereAnyCandidate() <= 0) {
            throw new Exception('There is no candidate.');
        }

        return $this->candidate->get();
    }

    /**
     * [Fetching all candidates by position]
     * @param  int    $position_id [description]
     * @return [type]              [description]
     */
    public function getAllCandidatesByPosition(int $position_id)
    {
        if ($this->isThereAnyCandidate() <= 0) {
            throw new Exception('There is no candidate.');
        }

        return $this->candidate->where('position_id',$position_id)->get();
    }

    /**
     * [Get the list of candidates by position name]
     * @return [type] [list of all candidates with student info]
     */
    public function getAllCandidatesByPositionName(string $position)
    {
        return $this->candidate
                    ->whereHas('position',function ($query) use ($position)
                     { $query->where('name',$position); })->with('studentInfo')->get();
    }

    /**
     * [Check if there's any position]
     * @return boolean [description]
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
     * [Get the no. of candidates by position ID]
     * @param  int    $id [description]
     * @return [type]     [description]
     */
    public function getNoOfCandidateByPositionId(int $id) :int
    {
        $candidates = $this->candidate->where('position_id',$id);
        return (is_null($candidates) ? 0 : $candidates->get()->count());
    }

    /**
     * [Get all candidates with votes]
     * @return [type] [description]
     */
    public function candidatesWithVote()
    {
        return $this->candidate
                     ->with(['studentInfo','votes'])
                     ->get();
    }

    /**
     * [Get all candidates with information and the position that their running]
     * @return [type] [description]
     */
    public function getCandidatesWithInfo()
    {
        return $this->candidate
                    ->with(['studentInfo','position'])
                    ->get();
    }

    /**
     * [Group the candidates by position and getting the count of votes]
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
     * [Create new candidate]
     * @param  array  $information [description]
     * @return [type]              [description]
     */
    public function createCandidate(array $information) : Candidate
    {
        //add profile for candidate
        $this->changeProfile($information);

        //check if there's uploaded image otherwise set a default image
        $information['profile'] = !empty($information['profile'])
        ? $information['profile']->getClientOriginalName() : 'no_image.png';

        return $this->candidate
                    ->create($information);
    }

    /**
     * [Move the Uploaded image of candidate to a folder]
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
