<?php

namespace App\Http\Controllers\Admin;
use App\Candidate;
use App\Http\Controllers\Controller;
use App\Repositories\CandidateRepository;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    public function __construct(CandidateRepository $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
    }

    public function index()
    {
        $candidates = $this->candidateRepository
                            ->candidatesWithVote();
        return view('admin.voting.index',compact('candidates'));
    }
}
