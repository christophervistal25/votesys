<?php

namespace App\Http\Requests;

use App\Rules\PositionReachLimit;
use App\Repositories\PositionRepository;
use Urameshibr\Requests\FormRequest;


class StoreCandidateRequest extends FormRequest
{
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
		$errors = array_flatten($errors);
		foreach ($errors as &$value) {
			$value = preg_replace('/student id.+/', 'student is already a candidate.', $value);
		}
		$errors = rtrim(str_replace('.'," , ", implode('',$errors)),' , ');
		setFlashMessage('errors',$errors);
		return redirect()->route('candidate.create');
	}
}
