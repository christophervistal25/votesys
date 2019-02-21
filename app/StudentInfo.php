<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class StudentInfo extends Model
{
	public $timestamps = false;
	public $table = 'student_info';
    public $primaryKey = 'student_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id','firstname', 'middlename','lastname','profile'
    ];

    public function student()
    {
        return $this->belongsTo('App\Student','student_id');
    }

    public function candidate()
    {
        return $this->belongsTo('App\Candidate','student_id');
    }

}
