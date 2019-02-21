<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\StudentInfo;

class InfoController extends Controller
{
	public function show($id_number)
	{
		if (StudentInfo::find($id_number)) {
			return StudentInfo::find($id_number);
		} else {
			return response()->json(['message' => 'can\'t find the student.'],422);
		}
	}


}
