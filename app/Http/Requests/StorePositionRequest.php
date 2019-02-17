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

	public function response(array $errors)
	{
		$errors = array_flatten($errors);
		foreach ($errors as &$value) {
			$value = preg_replace('/name/', 'position', $value);
		}
		$errors = rtrim(str_replace('.'," , ", implode('',$errors)),' , ');
		setFlashMessage('errors',$errors);
		return redirect()->route('position.create');
	}
}
