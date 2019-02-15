<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Admin extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password','admin_info_id'
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
        return $this->hasOne('App\AdminInfo','id','admin_info_id');
    }
}
