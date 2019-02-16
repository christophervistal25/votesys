<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Repositories\StudentRepository;
use App\StudentInfo;
use Illuminate\Http\Request;

class AuthController extends Controller
{

	public function __construct(StudentRepository $studentRepo)
	{
		$this->studentRepo = $studentRepo;
	}

	public function login(Request $request)
	{
		$isAuthorize = $this->studentRepo
                            ->verify($request->student_id,$request->password);
        if ($isAuthorize) {
            return response()->json(['success' => true],200);
        } else {
            return response()->json(['success' => false],422);
        }
	}


}
