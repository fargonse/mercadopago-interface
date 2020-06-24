<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppToken extends Model
{
    use SoftDeletes;

    protected $guard = ['id'];

    public function getKeysAttribute($value){
        return json_decode($value);
    }
}
