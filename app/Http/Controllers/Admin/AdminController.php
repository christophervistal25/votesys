<?php

namespace App\Http\Controllers\Admin;
use App\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;
use App\Repositories\VoteStatusRepository;
use App\VoteStatus;
use Illuminate\Http\Request;

class AdminController extends Controller
{

	public function __construct(VoteStatusRepository $voteRepo)
	{
        $this->voteRepo = $voteRepo;
	}

    public function index()
    {
        $current_state_of_voting = $this->voteRepo
                                         ->getCurrentState();
        return view('admin.dashboard',compact('vote_status','current_state_of_voting'));
    }

}
