<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Position;
use App\Candidate;
use App\StudentInfo;
use App\Repositories\CandidateRepository;

class CandidateController extends Controller
{

    public function __construct(Candidate $candidate , CandidateRepository $candidateRepository)
    {
        $this->candidate = $candidate;
        $this->candidateRepository = $candidateRepository;
    }

    public function index()
    {
        $candidates = $this->candidate::with(['studentInfo','position'])->get();
        return view('admin.candidate.index',compact('candidates'));
    }

    public function create()
    {
        $positions = Position::all();
        $students = StudentInfo::all();
        return view('admin.candidate.create',compact('positions','students'));
    }

    public function store(Request $request)
    {
    	if (!$this->candidateRepository->alreadyExists($request->student_id)) {
    		return $this->candidateRepository->createCandidate($request->all());
    	} else {
            dd('Candidate is already exists');
    	}
    }
}
