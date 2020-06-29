<?php

namespace App\Repositories;

use App\Models\Preference;
use App\Repositories\Interfaces\PreferenceRepositoryInterface;
use App\Repositories\PreferencePayerRepository;
use Illuminate\Foundation\Auth\User;

class PreferenceRepository implements PreferenceRepositoryInterface{

    protected $payerRepository;

    public function __construct()
    {
        $this->payerRepository = new PreferencePayerRepository();
    }

    public function create(array $request, User $user)
    {
        $payer = $this->payerRepository->updateOrCreate( $request );
        $request["client_id"] = $user->client_id;
        $request["preference_payer_id"] = $payer->id;
        Preference::create($request);
    }
}
