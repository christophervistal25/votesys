<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Student;
use App\StudentInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Exception;
use App\Helpers\CSVUploader;

class StudentController extends Controller
{
    use CSVUploader;

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

      //reading the csv file
         $this->setPath(base_path('public/csv_files/'))
              ->setCsvFileName($request->file('csv'))
              ->moveFileToPublic()
              ->readContentFromPublic()
              ->convertToArrayWithDelimeter("/,|\n/")
              ->chunkInTo(5);

        try { //inserting the content of csv to database
            $this->prepareDataForStudentInfo()
                 ->insertStudentInfoData()
                 ->insertStudentCrendentials();
          setFlashMessage('status','Successfully import new data , <a href="/admin/students" style="text-decoration:underline; color:#fff;">Click this link to view</a>');
        } catch (Exception $e) {
          setFlashMessage('errors','Please review your CSV, the system detect that some data is already inserted.' . " <a href='/admin/students' style='text-decoration:underline;color:#fff;'>Click this link to proceed in students record.</a>");
        }

      return redirect()->route('student.import');
    }


}
