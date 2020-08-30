<?php

namespace App\Http\Controllers;

use App\Http\Requests\PreferenceRequest;
use App\Models\Preference;
use App\Models\User;
use App\Repositories\Interfaces\PreferenceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use MercadoPago;

class PreferenceController extends Controller
{
    /**
     *
     * @var PreferenceRepositoryInterface
     *
     */
    private $preferenceRepository;

    public function __construct(PreferenceRepositoryInterface $repository)
    {
        $this->preferenceRepository = $repository;
    }

    public function store(PreferenceRequest $request)
    {
        $link = $this->preferenceRepository->get_link( $request->all(), auth()->user() );

        return response()
            ->json( $link )
            ->setStatusCode(200 )
            ->setEncodingOptions(JSON_NUMERIC_CHECK );
    }




    public function temp(){
        $rows = DB::select('select * from export5');

        $user = User::find(11);

        foreach ( $rows as $row ){
            $data = [
                "external_reference" => $row->Id_Comprobante,
                "name" => $row->RES_nombre,
                "surname" => $row->RES_apelli,
                "email" => $row->RES_direml ?? $row->CLI_direml ?? $row->FAM_direml ?? "",
                "phone_number" => $row->RES_telefn ?? "",
                "identification_type" => "DNI",
                "identification_number" => $row->Filtro_Numero,
                "custom_id" => $row->Id_Comprobante,
                "title" => "Familia: (" . $row->NROFAM . ") " . $row->FAMILIA . " - " . $row->Id_Comprobante,
                "currency_id" => "ARS",
                "picture_url" => "",
                "description" => $row->Id_Comprobante,
                "category_id" => "Others",
                "quantity" => 1,
                "unit_price" => $row->IMPORTE,
            ];
            $preference = $this->repository->create( $data, $user );
        }
        dd($rows);
    }

    public function get_link(){
        $client = User::find(11)->client;

        MercadoPago\SDK::setAccessToken( $client->appToken->keys->access_token );

        $preferences = Preference::whereNull('link')->get();



        foreach ( $preferences as $preference ){
            $payer = new MercadoPago\Payer();
            $date = new \DateTime();
            $date->setTimezone(new \DateTimeZone('-4'));

            $payer->name = $preference->payer->name;
            $payer->surname = $preference->payer->surname;
            $payer->email = $preference->payer->email;

            $payer->date_created = $date->format('Y-m-d\TH:i:sP');

            $payer->phone = array(
                "area_code" => "",
                "number" => $preference->payer->phone_number
            );

            $payer->identification = array(
                "type" => $preference->payer->identification_type,
                "number" => $preference->payer->identification_number
            );
            $items = [];
            foreach ($preference->items as $item){
                $MPItem = new MercadoPago\Item();
                $MPItem->id = $item->custom_id;
                $MPItem->title = $item->title;
                $MPItem->quantity = $item->quantity;
                $MPItem->currency_id = $item->currency_id;
                $MPItem->unit_price = $item->unit_price;
                array_push($items, $item);
            }

            $MPPreference = new MercadoPago\Preference();
            $MPPreference->items = $items;
            $MPPreference->payer = $payer;
            $MPPreference->external_reference = $preference->external_reference;
            $MPPreference->binary_mode = true;
            $MPPreference->save();

            $preference->link = $MPPreference->init_point;
            $preference->save();

            // return $MPPreference->init_point;
        }
    }
}
