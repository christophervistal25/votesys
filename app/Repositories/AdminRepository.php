<?php

namespace App\Repositories;
use App\Admin;
use Illuminate\Support\Facades\Hash;

class AdminRepository
{
    
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    /**
     * Get the information of the user by username
     * @param string $username
     * @return Admin
     */
    public function getInfoByUsername(string $username) :Admin
    {
        return $this->admin->where('username',$username)->first() ?? null;
    }

    /**
     * Check the user credentials
     *
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function verify(string $username , string $password) : bool
    {
       $admin = $this->getInfoByUsername($username);
       if ($admin !== null) {
            return Hash::check($password, $admin->password);
       }
       return false;

    }
}
