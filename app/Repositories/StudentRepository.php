<?php

namespace App\Repositories;
use App\Candidate;
use App\Student;
use Illuminate\Support\Facades\Hash;

class StudentRepository
{
    public $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
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
}
