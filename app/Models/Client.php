<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'alias',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function getEnv(){
        return app()->environment();
    }

    public function appToken()
    {
        return $this
            ->hasOne(AppToken::class)
            ->where('mode', app()->environment());
    }
}
