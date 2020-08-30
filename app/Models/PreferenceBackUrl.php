<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreferenceBackUrl extends Model
{
    protected $guarded = [ 'id' ];

    protected $fillable = [
        'preference_id',
        'success',
        'failure',
        'pending',
    ];
}
