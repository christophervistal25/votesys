<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class AdminInfo extends Model
{
	public $timestamps = false;
    protected $table = 'admin_info';
    
    /**
     * The attributes that are mass assignable.
     *`
     * @var array
     */
    protected $fillable = [
        'firstname', 'middlename','lastname','profile'
    ];

    public function admin()
    {
        return $this->belongsTo('App\Admin','id','admin_info_id');
    }

}
