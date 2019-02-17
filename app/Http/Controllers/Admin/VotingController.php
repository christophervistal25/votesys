<?php

namespace App\Http\Controllers\Admin;
use App\Candidate;
use App\Http\Controllers\Controller;
use App\Repositories\CandidateRepository;
use App\Repositories\PositionRepository;
use App\Repositories\VoteRepository;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    public function __construct(CandidateRepository $candidateRepo ,  PositionRepository $positionRepo , VoteRepository $voteRepo)
    {
        $this->candidateRepo = $candidateRepo;
        $this->positionRepo = $positionRepo;
        $this->voteRepo = $voteRepo;
    }

    public function index()
    {
        $positions = $this->positionRepo
                           ->position->get(['id','name']);
        $candidates = $this->candidateRepo
                            ->candidatesWithVote();
        return view('admin.voting.index',compact('candidates','positions'));
    }

    public function getNewVotes()
    {
         $positions = $this->positionRepo
                           ->position->get(['id','name']);
         $candidates = $this->candidateRepo
                            ->candidatesWithVote();
        return response()->json(['positions' => $positions, 'candidates' => $candidates]);
    }

    public function getLatestVotes(Request $request)
    {
        if (isset($request->last_vote)) {
            //check if there's new vote
            $record = $this->voteRepo->getRecordGreaterThan($request->last_vote);
            if (count($record) !== 0) {
                return response()->json([
                    'candidate' =>
                     Candidate::where('id',$record[0]->candidate_id)->with(['studentInfo','position'])->first(),
                    'update_vote_date' => $record[0]->created_at
                ]);
            } else {
                return response()->json(['message' => 'no record' , 'update_vote_date' => $request->last_vote]);
            }
        }
    }
}
