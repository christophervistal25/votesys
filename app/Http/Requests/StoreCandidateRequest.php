<?php

namespace App\Http\Requests;

use App\Rules\PositionReachLimit;
use App\Repositories\PositionRepository;
use Urameshibr\Requests\FormRequest;
use App\Helpers\Response;

class StoreCandidateRequest extends FormRequest
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
			'student_id' => 'required|unique:candidates,student_id',
			'position_id' => ['required', new PositionReachLimit($this->position)],
			'platforms' => 'required'
		];
	}

	public function response(array $errors)
	{
		return $this->setErrors($errors)
			->findAndReplaceErrorMessage('/student id.+/','student is already a candidate')
		     ->displayErrors()
		     ->toRoute('candidate.create');
	}
}
