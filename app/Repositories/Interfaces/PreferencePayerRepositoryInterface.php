<?php

namespace App\Repositories\Interfaces;

interface PreferencePayerRepositoryInterface{

    public function create(array  $request);

    public function updateOrCreate(array  $request);

}
