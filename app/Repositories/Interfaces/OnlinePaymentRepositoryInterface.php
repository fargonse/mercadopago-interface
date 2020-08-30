<?php


namespace App\Repositories\Interfaces;


use App\Models\Preference;
use App\Models\User;

interface OnlinePaymentRepositoryInterface
{
    public function get_link( Preference $preference, User $user );
}
