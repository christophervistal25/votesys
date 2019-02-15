<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Student extends Model
{
    public $timestamps = false;
    public $primaryKey = 'student_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function info()
    {
        return $this->hasOne('App\StudentInfo','student_id');
    }

    public function student_vote()
    {
        return $this->belongsToMany('App\Candidate','student_vote','student_id','candidate_id');
    }

}
