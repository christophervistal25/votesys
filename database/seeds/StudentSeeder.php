<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Student;
use App\StudentInfo;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student_ids = range(1501755,1501770);
        $i = 0;
        foreach ($student_ids as $value) {
            $i++;
        	Student::create([
        		'student_id' => $value,
        		// 'password' => Hash::make(1234),
        	]);
        	StudentInfo::create([
				'student_id' => $value,
				'firstname'  => $i . 'John',
				'middlename' => 'Doe',
				'lastname'   => 'Al',
        	]);
        }
    }
}
