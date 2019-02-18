<?php

namespace App\Http\Requests;

use App\Helpers\Response;
use App\Repositories\PositionRepository;
use App\Rules\PositionExists;
use Urameshibr\Requests\FormRequest;

class StorePositionRequest extends FormRequest
{
	use Response;
	public function __construct(PositionRepository $position)
	{
		$this->position = $position;
	}

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => ['required',new PositionExists($this->position)],
			'limit' => 'required',
			'student_can_vote' => 'required',
		];
	}

	public function response(array $errors)
	{
		return $this->setErrors($errors)
			->findAndReplaceErrorMessage('/name/','position')
		     ->displayErrors()
		     ->toPreviousPage();
	}
}
