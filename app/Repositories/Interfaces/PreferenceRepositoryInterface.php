<?php

namespace App\Repositories\Interfaces;

use Illuminate\Foundation\Auth\User;

interface PreferenceRepositoryInterface{

    public function create(array  $request, User $user);

}
