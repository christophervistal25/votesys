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
     * [Check the Admin credentials]
     * @param  string $username [description]
     * @param  string $password [description]
     * @return [type]           [description]
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
     * [Update the information of admin depending on request type]
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
     * [Checking if the admin want to change profile]
     * @param  [type]  $items [description]
     * @return boolean        [description]
     */
    private function isAdminWantToChangeProfile($items)
    {
        if (isset($items['profile'])) {

            //getting the image name
            $image = $items['profile']->getClientOriginalName();

            //updating the profile of admin
            getAdminInfo()->update(['profile' => $image]);

            //move the uploaded image to a folder
            $items['profile']->move(base_path('/public/images'),$image);

        }
    }

    /**
     * [Change the Admin information]
     * @return [type] [description]
     */
    private function changeInformation(array $items = []) : bool
    {
        //get information of admin by it's INFO_ID
        $admin = getAdminCredentials(['admin_info_id']);

        //update
        return $this->adminInfo->where('id',$admin->admin_info_id)->update([
            'firstname'  => $items['firstname'],
            'middlename' => $items['middlename'],
            'lastname'   => $items['lastname']
        ]);
    }

    /**
     * [Changing admin username]
     * @param  array  $items [description]
     * @return [type]        [description]
     */
    private function changeUsername(array $items = []) : bool
    {
        //get admin username
        $admin = getAdminCredentials(['username']);

        //update
        return $this->getInfoByUsername($admin->username)
                    ->update($items);
    }

    /**
     * [Changing password of the admin]
     * @param  array  $items [description]
     * @return [type]        [description]
     */
    private function changePassword(array $items = [])
    {
        //get the username of admin
        $admin = getAdminCredentials(['username']);
        
        //get information using it's username and update password
        return $this->getInfoByUsername($admin->username)
                    ->update(['password' => Hash::make($items['new_password'])]);
    }
}
