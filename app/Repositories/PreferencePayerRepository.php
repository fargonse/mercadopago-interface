<?php

namespace App\Repositories;

use App\Models\PreferencePayer;
use App\Repositories\Interfaces\PreferencePayerRepositoryInterface;

class PreferencePayerRepository implements PreferencePayerRepositoryInterface{
    public function create(array $request)
    {
        // TODO: Implement create() method.
    }

    public function updateOrCreate(array $request)
    {
        $payer = PreferencePayer::firstOrCreate(
            [
                'identification_type' => $request["identification_type"],
                'identification_number' => $request["identification_number"],
            ], $request
        );

        return $payer;
    }
}
