<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Student;
use App\StudentInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use League\Csv\Reader;
use League\Csv\Statement;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('info')->get();
        return view('admin.students.index',compact('students'));
    }

    public function import()
    {
    	return view('admin.students.import');
    }

    public function process_import(Request $request)
    {
        //refactor this
        $csv =   time() . '_' . $request->file('csv')->getClientOriginalName();
        $request->file('csv')->move(base_path('/public/csv_files'),$csv);
        $file = file_get_contents(base_path('public/csv_files/'.$csv));
        $file_array = preg_split("/,|\n/", str_replace("\r", '', $file));
        $file_array = array_chunk(array_filter($file_array), 5);
        $student_info = null;
        $student = null;
        foreach ($file_array as $key => $value) {
            $student_info .= "('" . $value[0] ."','". $value[1] ."','". $value[2] ."','". $value[3] ."','". $value[4] . "'),";
            $student .= "(" . $value[0]."),";
        }
        $student_info = rtrim($student_info,',');
        $student = rtrim($student,',');
        $pdo = DB::getPdo();
        $pdo->exec("INSERT INTO students(`student_id`) VALUES $student");
        dd($pdo->exec("INSERT INTO student_info(`student_id`,`firstname`,`middlename`,`lastname`,`profile`) VALUES $student_info"));
    }


}
