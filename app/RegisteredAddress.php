<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class RegisteredAddress extends Model
{
    public $fillable = ['mac_address'];
    public $table = 'registered_address';
    public $primaryKey = 'mac_address';
}
