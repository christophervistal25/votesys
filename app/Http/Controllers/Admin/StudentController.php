<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('info')->get();
        return view('admin.students.index',compact('students'));
    }


}
