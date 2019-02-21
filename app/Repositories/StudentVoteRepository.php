<?php

namespace App\Repositories;
use App\Repositories\CandidateRepository;

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
}
