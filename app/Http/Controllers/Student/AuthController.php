<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\RegisteredAddress;
use App\Repositories\RegisterAddressRepository;
use App\Repositories\StudentRepository;
use App\StudentInfo;
use Illuminate\Http\Request;

class AuthController extends Controller
{

	public function __construct(StudentRepository $studentRepo , RegisterAddressRepository $registerAddressRepository)
	{
		$this->studentRepository = $studentRepo;
		$this->registerAddressRepository = $registerAddressRepository;
	}

	public function login(Request $request)
	{
		$isAuthorize = $this->studentRepository
							->verify($request->student_id,$request->password);
        if ($isAuthorize) {
            return response()->json(['login_status' => true],200);
        } else {
            return response()->json(['login_status' => false],422);
        }
	}

	/**
	 * [trigger in /api/student/register endpoint]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function register(Request $request)
	{
		//check if student is in the list of voters
		if ($this->studentRepository->verifyStudentID($request->id_number)) {
			//update the password of student in table
			if ($this->studentRepository->update($request->all())) {
				//insert the mac address of registered user in DB
				$this->registerAddressRepository->create($request->all());
				return response()->json(['success' => true], 200);
			}
		}
		return response()->json(['success' => false],422);

	}


}
