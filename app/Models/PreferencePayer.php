<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreferencePayer extends Model
{

    protected $guard = ['id'];

    public function preferences(){
        $this->hasMany( Preference::class );
    }
}
