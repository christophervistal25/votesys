<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\VoteStatus;
use App\Repositories\VoteStatusRepository;


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
		return redirect('/admin/dashboard');
   }

}
