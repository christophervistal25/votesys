<?php
namespace App\Helpers;
use App\Helpers\CSVReader;
use Illuminate\Support\Facades\DB;
use PDO;

trait CSVUploader {

	use CSVReader;

	private $student_info , $student;

	public function prepareDataForStudentInfo()
	{
		foreach ($this->getContent() as $key => $value) {
			$this->student_info .= "('" . $value[0] ."','". $value[1] ."','". $value[2] ."','". $value[3] ."','". $value[4] . "'),";
			$this->student .= "(" . $value[0]."),";
		}
		$this->student_info = rtrim($this->student_info,",");
		$this->student = rtrim($this->student,",");
		return $this;
	}

	public function insertStudentInfoData()
	{
		DB::getPdo()->exec("INSERT INTO student_info(`student_id`,`firstname`,`middlename`,`lastname`,`profile`) VALUES $this->student_info");
		return $this;
	}

	public function insertStudentCrendentials()
	{
		DB::getPdo()->exec("INSERT INTO students(`student_id`) VALUES $this->student");
		return $this;
	}

}
