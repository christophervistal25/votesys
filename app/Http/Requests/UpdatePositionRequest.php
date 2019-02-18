<?php

namespace App\Http\Requests;

use App\Repositories\PositionRepository;
use Illuminate\Support\Facades\URL;
use Urameshibr\Requests\FormRequest;
use App\Helpers\Response;

class UpdatePositionRequest extends FormRequest
{
	use Response;

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

	/**
	 * Redirect and give the error message
	 * @param  array  $errors [description]
	 * @return [type]         [description]
	 */
	public function response(array $errors)
	{
		return $this->setErrors($errors)
			->findAndReplaceErrorMessage('/name/','position')
		     ->displayErrors()
		     ->toPreviousPage();
	}
}
