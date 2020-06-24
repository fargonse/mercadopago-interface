<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $guard = ['id'];

    protected $fillable = [
        'name',
        'alias',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
