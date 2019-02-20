<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Repositories\StudentVoteRepository;

class VoteController extends Controller
{

	public function __construct(StudentVoteRepository $studentVoteRepo)
	{
		$this->studentVoteRepo = $studentVoteRepo;
	}

	public function vote(Request $reques)
	{
		return $this->studentVoteRepo->vote();
	}
}
