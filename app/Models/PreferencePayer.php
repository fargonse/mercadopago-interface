<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreferencePayer extends Model
{

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone_number',
        'identification_type',
        'identification_number',
    ];

    public function preferences(){
        return $this->hasMany( Preference::class );
    }
}
