<?php

namespace App\Repositories;

class StudentVoteRepository
{

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
	 * [Process the request of student to vote]
	 * @return [type] [description]
	 */
	public function vote(array $items) 
	{
		if ($this->isVotingOpen()) {
			//process the request of the student here
			//for now just display the response json
			return response()->json(['message' => 'Student can vote'],200);
		}
		return response()->json(['message' => 'Sorry! Voting is closed!'],422);
	}
}
