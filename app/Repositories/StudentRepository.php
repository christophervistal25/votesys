<?php

namespace App\Repositories;
use App\Candidate;
use App\Student;
use App\StudentInfo;
use Illuminate\Support\Facades\Hash;

class StudentRepository
{
    public $student;

    public function __construct(Student $student, StudentInfo $student_info)
    {
        $this->student = $student;
        $this->student_info = $student_info;
    }

    /**
     * Check student credentials
     *
     * @param integer $student_id_number
     * @param string $password
     * @return boolean
     */
    public function verify(int $student_id_number , string $password) : bool
    {
      $student = $this->student->find($student_id_number);
       if ($student !== null) {
            return Hash::check($password, $student->password);
       }
       return false;
    }

    public function verifyStudentID($id_number) : bool
    {
        return !is_null($this->student->find($id_number));
    }

    public function update(array $items) : bool
    {
       return $this->student->find($items['id_number'])->update([
            'password' => Hash::make($items['password']),
       ]);
    }

    public function getStudentVoteInAPosition($candidate,int $student_id) :int
    {
        return $this->student->find($student_id)
                             ->student_vote->where('position_id',$candidate->position->id)
                             ->count();
    }

    public function getStudentInfo(int $id_number)
    {
        return $this->student_info->find($id_number);
    }
}
