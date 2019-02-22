<?php

namespace App\Http\Controllers\Student;
use App\Candidate;
use App\Http\Controllers\Controller;
use App\Position;
use App\Repositories\CandidateRepository;

class CandidatesController extends Controller
{
	public function __construct(CandidateRepository $candidateRepository)
	{
		$this->candidateRepository = $candidateRepository;
	}

	public function candidateInAPosition(int $position_id)
	{
		return response()->json($this->candidateRepository->getAllCandidatesByPosition($position_id));
	}

	public function candidatesByPositionName(string $position , string  $voter_student_id)
	{
		$candidatesForThePosition = $this->candidateRepository
										 ->getAllCandidatesByPositionName($position);
		return view('mobile.candidates',compact('candidatesForThePosition','voter_student_id'));
	}

	public function candidates()
	{
		return response()->json($this->candidateRepository->getAllCandidates());
	}
}
