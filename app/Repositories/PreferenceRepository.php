<?php

namespace App\Repositories;

use App\Models\Preference;
use App\Repositories\Interfaces\PreferenceRepositoryInterface;
use App\Repositories\PreferencePayerRepository;
use Illuminate\Foundation\Auth\User;

class PreferenceRepository implements PreferenceRepositoryInterface{

    protected $payerRepository;
    protected $itemRepository;

    public function __construct()
    {
        $this->payerRepository = new PreferencePayerRepository();
        $this->itemRepository = new PreferenceItemRepository();
    }

    public function create(array $request, User $user)
    {
        $payer = $this->payerRepository->updateOrCreate( $request );

        $request["client_id"] = $user->client_id;

        $request["preference_payer_id"] = $payer->id;

        $preference = Preference::create($request);

        $request["preference_id"] = $preference->id;

        $item = $this->itemRepository->create( $request );
    }
}
