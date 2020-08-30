<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PreferenceRepositoryInterface;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;

class PreferenceRepository implements PreferenceRepositoryInterface{

    protected $payerRepository;
    protected $itemRepository;
    protected $paymentMethodRepository;

    public function __construct()
    {
        $this->payerRepository = new PreferencePayerRepository();
        $this->itemRepository = new PreferenceItemRepository();
        $this->mercadoPagoRepository = new MercadoPagoRepository();
    }

    public function get_link(array $request, User $user)
    {
        $preference = $this->create( $request, $user );

        return $this->mercadoPagoRepository->get_link( $preference, $user );
    }

    protected function create(array $request, User $user)
    {
        $link = null;
        DB::beginTransaction();

        try {
            $payer = $this->payerRepository->updateOrCreate( $request["payer"] );

            $request["client_id"] = $user->client_id;

            $preference = $payer->preferences()->create( $request );

            $preference->items()->create( $request["item"] );

            $preference->back_urls()->create( $request["back_urls"] );

            DB::commit();
        } catch ( \Throwable $e){
            DB::rollBack();
            throw new \Exception( $e->getMessage(), $e->getCode() );
        }

        return $preference;
    }
}
