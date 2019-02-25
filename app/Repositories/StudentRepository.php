<?php

namespace App\Repositories;
use App\Candidate;
use App\Position;
use App\Repositories\StudentVoteRepository;
use App\Student;
use App\StudentInfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentRepository
{
    public $student;

    public function __construct(Student $student, StudentInfo $student_info )
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

    /**
     * [Check if the student id is legitimate to vote]
     * @param  [type] $id_number [description]
     * @return [type]            [description]
     */
    public function verifyStudentID($id_number) : bool
    {
        return !is_null(
                    $this->student->find($id_number,['student_id'])
         );
    }

    /**
     * [Update student login credentials]
     * @param  array  $items [description]
     * @return [type]        [description]
     */
    public function update(array $items) : bool
    {
       return $this->student
                    ->find($items['id_number'])
                    ->update(['password' => Hash::make($items['password'])]);
    }

    /**
     * [Get the no. of student votes in position ]
     * @param  [type] $candidate  [description]
     * @param  int    $student_id [description]
     * @return [type]             [description]
     */
    public function getStudentVoteInAPosition($candidate,int $student_id) :int
    {
        return $this->student->find($student_id)
                             ->student_vote->where('position_id',$candidate->position->id)
                             ->count();
    }

    /**
     * [Get the student info with corresponding no. of it's votes per position]
     * @param  int    $id_number [description]
     * @return [type]            [description]
     */
    public function getStudentInfo(int $id_number)
    {
        //fetch student information
        $information = $this->student_info->find($id_number);

        //get all positons of candidates
        $candidates = Candidate::get(['position_id']);

        //loop through all candidates
        foreach ($candidates as $candidate) {

            //finding the name of the position using it's primary key
            //to prepare a property name
            $position = 'can_vote_to_'
                        . strtolower(Position::find($candidate->position_id,['name'])->name);

            //create a property with value of whether student can vote to a position or not
            $information->$position = $candidate->position->student_can_vote > $this->getStudentVoteInAPosition($candidate,$id_number);
        }

        return $information;
    }
}
