<?php

namespace App\Repositories;
use App\VoteStatus;

class VoteStatusRepository
{
    public function __construct(VoteStatus $vote_status)
    {
        $this->vote_status = $vote_status;
    }

    /**
     * Get the current state of voting
     * @return void
     */
    public function getCurrentState()
    {
      return $this->vote_status->first()->status;
    }


    /**
     * Change the current state of the voting
     * notice that I put 1 because there is only one
     * record in vote_status in DB
     * @return void
     */
    public function changeState()
    {
      $state = ($this->getCurrentState() === 'open') ? 'closed' : 'open';
      return $this->vote_status->find(1)->update(['status' => $state]);
    }

}
