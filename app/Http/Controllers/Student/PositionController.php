<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Repositories\PositionRepository;

class PositionController extends Controller
{
	public function __construct(PositionRepository $positionRepository)
	{
		$this->positionRepository = $positionRepository;
	}

	public function list()
	{
		return $this->positionRepository->getOnly(['name']);
	}

}
