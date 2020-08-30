<?php

namespace App\Repositories\Interfaces;

use Illuminate\Foundation\Auth\User;

interface PreferenceRepositoryInterface{

    public function get_link(array  $request, User $user);

}
