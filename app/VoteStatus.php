<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class VoteStatus extends Model
{
	public $timestamps = false;
	public $table = 'vote_status';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status'
    ];

}
