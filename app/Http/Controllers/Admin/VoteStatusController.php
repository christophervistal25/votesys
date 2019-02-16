<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\VoteStatusRepository;
use App\VoteStatus;
use Illuminate\Http\Request;


class VoteStatusController extends Controller
{
	public function __construct(VoteStatus $voting_status , VoteStatusRepository $voteRepo)
	{
		$this->voting_status = $voting_status;
		$this->voteRepo = $voteRepo;
	}

   public function update()
   {
   		$this->voteRepo->changeState();
		return redirect()->route('admin.dashboard');
   }

}
