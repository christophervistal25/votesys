<?php

namespace App\Http\Controllers\Admin;
use App\Candidate;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCandidateRequest;
use App\Position;
use App\Repositories\CandidateRepository;
use App\Repositories\PositionRepository;
use App\StudentInfo;
use Illuminate\Http\Request;

class CandidateController extends Controller
{

    public function __construct(CandidateRepository $candidateRepository , PositionRepository $positionRepo)
    {
        $this->candidateRepository = $candidateRepository;
        $this->positionRepository = $positionRepo;
    }

    public function index()
    {
        $candidates = $this->candidateRepository
                            ->getCandidatesWithInfo();
        return view('admin.candidate.index',compact('candidates'));
    }

    public function create()
    {
        $need_data = [
            'positions' => Position::all(),
            'students' => StudentInfo::all(),
        ];
        return view('admin.candidate.create',compact('need_data'));

    }

    public function store(StoreCandidateRequest $request)
    {
        $this->candidateRepository
              ->createCandidate($request->all());
            setFlashMessage('status','Successfully add new candidate.');
        return redirect()->route('candidate.index');
    }

    public function ranks()
    {
        $candidates = $this->candidateRepository
                            ->getCandidatesWithVotesForRank();
        $positions = $this->positionRepository
                          ->position
                          ->all();
        return view('admin.candidate.ranks',compact('candidates','positions'));
    }
}
