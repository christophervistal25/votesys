<?php

namespace App\Http\Controllers\Student;
use App\Candidate;
use App\Http\Controllers\Controller;
use App\Position;
use App\Repositories\CandidateRepository;
use App\Student;

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
		//get all candidates by position name this mean
		//by Governor , Senator, etc.
		$candidatesForThePosition = $this->candidateRepository
										 ->getAllCandidatesByPositionName($position);

	   //find all candidates that the voter already vote
	   //this will return an object of collection
		$voterListOfVotes = Student::with('student_vote')->find($voter_student_id)->student_vote->pluck('id');

		//convert to array
		$list_of_votes = array_flatten($voterListOfVotes);

		//filter the candidates by the list of voters already vote
		$filtered_candidates =  $candidatesForThePosition->filter(function ($value , $key) use ($list_of_votes) {
			return (! in_array($value->id,$list_of_votes)) ? $value : null;
		});

		//in order to do not modify the view we need to pass in the
		//filtered in candidatesForThePosition
		//
		$candidatesForThePosition = $filtered_candidates;
		return view('mobile.candidates',compact('candidatesForThePosition','voter_student_id','voterListOfVotes'));
	}

	public function candidates()
	{
		return response()->json($this->candidateRepository->getAllCandidates());
	}

}
