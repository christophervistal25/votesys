<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Admin;
use App\VoteStatus;
use App\Repositories\AdminRepository;
use App\Repositories\VoteStatusRepository;

class AdminController extends Controller
{

	public function __construct(VoteStatusRepository $voteRepo)
	{
        $this->voteRepo = $voteRepo;
	}

    public function index()
    {
    	$current_state_of_voting = $this->voteRepo->getCurrentState();
        return view('admin.dashboard',compact('vote_status','current_state_of_voting'));
    }

}
