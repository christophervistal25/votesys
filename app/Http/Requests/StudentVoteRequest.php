<?php

namespace App\Http\Requests;


use Urameshibr\Requests\FormRequest;
use App\Rules\CandidateCheck;
use App\Repositories\CandidateRepository;

class StudentVoteRequest extends FormRequest
{
	public function __construct(CandidateRepository $candidateRepository)
	{
		$this->candidateRepository = $candidateRepository;
	}
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'student_id' => 'required',
			'candidate_id' => ['required',new CandidateCheck($this->candidateRepository)],
		];
	}

}
