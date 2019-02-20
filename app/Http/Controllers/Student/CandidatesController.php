<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Repositories\CandidateRepository;

class CandidatesController extends Controller
{
	public function __construct(CandidateRepository $candidateRepository)
	{
		$this->candidateRepository = $candidateRepository;
	}

	public function candidates()
	{
		return response()->json($this->candidateRepository->getAllCandidates());
	}
}
