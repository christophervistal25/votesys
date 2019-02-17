<?php
namespace App\Rules;

use App\Repositories\AdminRepository;
use Illuminate\Contracts\Validation\Rule;

class isPasswordCorrect implements Rule
{


    public function __construct(AdminRepository $adminRepo)
    {
        $this->adminRepository = $adminRepo;
    }

     /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $admin = getAdminCredentials(['username']);
        return $this->adminRepository->verify($admin->username , $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please check your password.';
    }
}
