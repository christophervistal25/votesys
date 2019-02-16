<?php

namespace App\Http\Controllers\Admin;
use App\Admin;
use App\AdminInfo;
use App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;
use App\Repositories\VoteStatusRepository;
use App\VoteStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

	public function __construct(VoteStatusRepository $voteRepo)
	{
        $this->voteRepo = $voteRepo;
	}

    public function index()
    {
        return view('admin.dashboard');
    }

}
