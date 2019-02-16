<?php

namespace App\Http\Requests;

use App\Rules\PositionExists;
use App\Repositories\PositionRepository;
use Urameshibr\Requests\FormRequest;


class StorePositionRequest extends FormRequest
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
			'name' => ['required',new PositionExists($this->position)],
			'limit' => 'required',
		];
	}
}
