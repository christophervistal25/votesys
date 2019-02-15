<?php

namespace App\Http\Controllers\Student;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use App\StudentInfo;
use App\Repositories\StudentRepository;

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
