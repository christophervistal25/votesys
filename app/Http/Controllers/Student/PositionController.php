<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Position;

class PositionController extends Controller
{
	public function list()
	{
		return Position::get(['name']);
	}

}
