<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Admin;
use App\Repositories\AdminRepository;

class AuthController extends Controller
{
    public function __construct(Admin $admin,AdminRepository $adminRepo)
    {
        $this->admin = $admin;
        $this->adminRepo = $adminRepo;
    }
    


    public function showLogin()
    {
        return view('admin.login');
    }
    

    public function checkUser(Request $request)
    {
        $isAuthorize = $this->adminRepo
                            ->verify($request->username,$request->password);
        if ($isAuthorize) {
            dd('good');
        } else {
            dd('Please check your username or password');
        }
    }
}
