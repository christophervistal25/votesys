<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Repositories\StudentVoteRepository;
use App\Http\Requests\StudentVoteRequest;
use Illuminate\Http\Request;

class VoteController extends Controller
{

	public function __construct(StudentVoteRepository $studentVoteRepo)
	{
		$this->studentVoteRepo = $studentVoteRepo;
	}

	public function vote(StudentVoteRequest $request)
	{
		return $this->studentVoteRepo
					->vote($request->all());
	}

}
