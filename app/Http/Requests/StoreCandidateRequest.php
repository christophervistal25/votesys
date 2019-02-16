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
			'position_id' => ['required', new PositionReachLimit($this->position)]
		];
	}
}
