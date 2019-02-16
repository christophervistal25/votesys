<?php

namespace App\Http\Controllers\Admin;
use App\Candidate;
use App\Http\Controllers\Controller;
use App\Repositories\CandidateRepository;
use App\Repositories\PositionRepository;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    public function __construct(CandidateRepository $candidateRepository ,  PositionRepository $positionRepo)
    {
        $this->candidateRepository = $candidateRepository;
        $this->positionRepository = $positionRepo;
    }

    public function index()
    {
        $positions = $this->positionRepository
                           ->position->get(['id','name']);
        $candidates = $this->candidateRepository
                            ->candidatesWithVote();
        return view('admin.voting.index',compact('candidates','positions'));
    }

    public function getVotes()
    {
         $positions = $this->positionRepository
                           ->position->get(['id','name']);
        $candidates = $this->candidateRepository
                            ->candidatesWithVote();
        return response()->json(['positions' => $positions, 'candidates' => $candidates]);
    }
}
