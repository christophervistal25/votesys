<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Position extends Model
{
	public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'limit','student_can_vote'
    ];


    public function candidate()
    {
    	return $this->hasMany('App\Candidate','position_id');
    }

}
