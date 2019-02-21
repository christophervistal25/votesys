<?php

namespace App\Repositories;
use App\Repositories\CandidateRepository;
use App\Repositories\StudentRepository;

class StudentVoteRepository
{

	public function __construct(CandidateRepository $candidateRepository)
	{
		$this->candidateRepository = $candidateRepository;
	}

	/**
	 * [the method is local at VoteStatus in Helpers directory]
	 * @return [type] [description]
	 */
	public function checkVotingStatus()
	{
		return getCurrentStateOfVote();
	}

	/**
	 * [Checking the voting state if open]
	 * @return boolean [description]
	 */
	public function isVotingOpen()
	{
		return $this->checkVotingStatus() === 'open';
	}

	/**
	 * [Add vote a candidate]
	 * @return [type] [description]
	 */
	public function vote(array $items)
	{
		// attach the student vote
		$this->candidateRepository
			  ->candidate->find($items['candidate_id'])
			  ->votes()->attach($items['student_id']);
		 return response()->json(['message' => 'Successfully add your vote.'],200);
	}


	/**
	 * [Checking if the votes reach the limit for a specific position]
	 * @param  StudentRepository $studentRepo [description]
	 * @param  array             $items       [description]
	 * @return boolean                        [description]
	 */
	public function isVoterReachTheLimitForPosition(StudentRepository $studentRepo , array $items = []) :bool
	{
		//return information about the candidate
		   $candidate_position = $this->candidateRepository
		                              ->candidate
		                              ->find($items['candidate_id']);

		//get the student vote in position of candidate
		   $student_no_of_votes = $studentRepo->getStudentVoteInAPosition($candidate_position,$items['student_id']);

		   return  $candidate_position->position->student_can_vote > $student_no_of_votes;
	}


}
