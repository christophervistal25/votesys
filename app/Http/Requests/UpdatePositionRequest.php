<?php

namespace App\Http\Requests;

use App\Repositories\PositionRepository;
use Illuminate\Support\Facades\URL;
use Urameshibr\Requests\FormRequest;

class UpdatePositionRequest extends FormRequest
{

	public function __construct(PositionRepository $positionRepo)
	{
		$this->positionRepository = $positionRepo;
	}

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => ['required'],
			'limit' => 'required',
			'student_can_vote' => 'required',
		];
	}

	public function response(array $errors)
	{
		//refactor this
		$errors = array_flatten($errors);
		foreach ($errors as &$value) {
			$value = preg_replace('/name/', 'position', $value);
		}
		$errors = rtrim(str_replace('.'," , ", implode('',$errors)),' , ');
		//set flash message
		setFlashMessage('errors',$errors);
		$previous_url = $_SERVER['HTTP_REFERER'];
		return redirect($previous_url);
	}
}
