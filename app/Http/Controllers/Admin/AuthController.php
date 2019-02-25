<?php

namespace App\Http\Controllers\Admin;
use App\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(AdminRepository $adminRepo)
    {
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
            setFlashMessage('status','Welcome Administrator ' . $request->username);
            $_SESSION['login'] = true;
            return redirect()->route('admin.dashboard');
        } else {
            setFlashMessage('errors','Please check your username or password');
            return redirect()->route('login');
        }
    }

    public function logout()
    {

        if (session_id() == null) {
            session_start();
        }
        session_destroy();
        return redirect()->route('login');
    }
}
