<?php

namespace App\Repositories;
use App\Admin;
use App\AdminInfo;
use Illuminate\Support\Facades\Hash;

class AdminRepository
{

    public function __construct(Admin $admin , AdminInfo $adminInfo)
    {
        $this->admin = $admin;
        $this->adminInfo = $adminInfo;
    }

    /**
     * Get the information of the user by username
     * @param string $username
     * @return Admin
     */
    public function getInfoByUsername(string $username)
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

    /**
     * [update the information of admin depending on request type]
     * @param  string $method [description]
     * @param  array  $items  [description]
     * @return [type]         [description]
     */
    public function update(string $method , array $items = [])
    {
        $this->isAdminWantToChangeProfile($items ?? []);
        return $this->$method($items);
    }

    /**
     * [isAdminWantToChangeProfile if the admin want to change profile]
     * @param  [type]  $items [description]
     * @return boolean        [description]
     */
    private function isAdminWantToChangeProfile($items)
    {
        if (isset($items['profile'])) {
            $image = $items['profile']->getClientOriginalName();
            getAdminInfo()->update(['profile' => $image]);
            $items['profile']->move(base_path('/public/images'),$image);
        }
    }

    /**
     * [changeInformation change the admin info]
     * @return [type] [description]
     */
    private function changeInformation(array $items = []) : bool
    {
        $admin = getAdminCredentials(['admin_info_id']);
        return $this->adminInfo->where('id',$admin->admin_info_id)->update([
            'firstname'  => $items['firstname'],
            'middlename' => $items['middlename'],
            'lastname'   => $items['lastname']
        ]);
    }

    private function changeUsername(array $items = []) : bool
    {
        $admin = getAdminCredentials(['username']);
        return $this->getInfoByUsername($admin->username)
                    ->update($items);
    }

    private function changePassword(array $items = [])
    {
        $admin = getAdminCredentials(['username']);
        return $this->getInfoByUsername($admin->username)
                    ->update(['password' => Hash::make($items['new_password'])]);
    }
}
