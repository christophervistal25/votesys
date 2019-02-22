<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Repositories\StudentRepository;
use App\StudentInfo;
use Illuminate\Http\Request;

class InfoController extends Controller
{

	public function __construct(StudentRepository $studentRepository)
	{
		$this->studentRepository = $studentRepository;
	}

	public function show(int $id_number)
	{

		return $this->studentRepository->getStudentInfo($id_number)
		?? response()->json(['message' => 'Sorry but the system can\'t find the student.'],422);
	}


}
