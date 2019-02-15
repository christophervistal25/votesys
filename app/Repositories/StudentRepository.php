<?php

namespace App\Repositories;
use App\Student;
use Illuminate\Support\Facades\Hash;

class StudentRepository
{
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
}
