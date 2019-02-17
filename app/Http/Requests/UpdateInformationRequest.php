<?php

namespace App\Http\Requests;

use App\Repositories\AdminRepository;
use App\Rules\isPasswordCorrect;
use Urameshibr\Requests\FormRequest;


class UpdateInformationRequest extends FormRequest
{
	public function __construct(AdminRepository $adminRepo)
	{
		$this->adminRepostiory = $adminRepo;
	}

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		//check if the type of Update request
		if ($this->request->has('type')) {
			switch ($this->request->get('type')) {
				case 'changePassword' :
						return [
							'password' => ['required',new isPasswordCorrect($this->adminRepostiory)],
							'new_password' => 'required|required_with:confirm_new_password|same:confirm_new_password',
							'confirm_new_password' => 'required',
						];
					break;
				case 'changeUsername' :
						return [
							'username' => 'required|unique:admins,username',
						];
					break;

				case 'changeInformation' :
						return [
							'firstname'  => 'required',
							'middlename' => 'required',
							'lastname'   => 'required',
							'profile'    => 'nullable'
						];
					break;
			}
		}
	}

	public function response(array $errors)
	{
		$errors = array_flatten($errors);
		$errors = rtrim(str_replace('.'," , ", implode('',$errors)),' , ');
		setFlashMessage('errors',$errors);
		return redirect()->route('profile.show');
	}

}
