<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Candidate extends Model
{
	public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'position_id','platforms'
    ];

    public function studentInfo()
    {
        $this->primaryKey = 'student_id';
        return $this->hasOne('App\StudentInfo','student_id');
    }

    public function position()
    {
        return $this->hasOne('App\Position','id','position_id');
    }

    public function votes()
    {
        return $this->belongsToMany('App\Student','student_vote','candidate_id','student_id');
    }

    public function positionOfCandidate()
    {
        return $this->belongsToMany('App\Candidate');
    }


}
