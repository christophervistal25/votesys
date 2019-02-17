<?php

namespace App\Http\Controllers\Admin;
use App\Admin;
use App\AdminInfo;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateInformationRequest;
use App\Repositories\AdminRepository;
use App\Repositories\VoteStatusRepository;
use App\VoteStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class AdminController extends Controller
{

	public function __construct(VoteStatusRepository $voteRepo , AdminRepository $adminRepo)
	{
        $this->voteRepo = $voteRepo;
        $this->adminRepository = $adminRepo;
	}

    public function index()
    {
        return view('admin.dashboard');
    }

    public function show()
    {
        $info       = getAdminInfo();
        $login_info = getAdminCredentials(['id','username']);
    	return view('admin.profile.show',compact('info','login_info'));

    }

    public function update(UpdateInformationRequest $request)
    {
        $this->adminRepository->update($request->type,$request->all());
        setFlashMessage('status','Successfully update');
        return redirect()->route('profile.show');
    }

}
