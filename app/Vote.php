<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Vote extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'candidate_id', 'no_of_votes'
    ];

    public function candidate()
    {
    	return $this->hasOne('App\Candidate','id');
    }

    public function student()
    {
        return $this->hasMany('App\Student','student_vote','vote_id','student_id');
    }

}
