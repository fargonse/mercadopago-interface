<?php

namespace App\Http\Controllers;

use App\Http\Requests\BatchPreferenceRequest;
use App\Repositories\Interfaces\PreferenceRepositoryInterface;


class BatchPreferenceController extends Controller
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

    public function store(BatchPreferenceRequest $requests)
    {
        $collectionReturn = collect([]);

        foreach ( $requests->all() as $request ){
            $itemCollection = new \stdClass();

            $data["auto_return"] = "approved";
            $data["notification_url"] = null;
            $data["external_reference"] = $request["external_reference"];
            $data["expires"] = 0;
            $data["expiration_date_from"] = null;
            $data["expiration_date_to"] = null;

            $data["payer"]["name"] = $request["name"];
            $data["payer"]["surname"] = $request["surname"];
            $data["payer"]["email"] = $request["email"];
            $data["payer"]["phone_number"] = $request["phone_number"];
            $data["payer"]["identification_type"] = $request["identification_type"] ?? "DNI";
            $data["payer"]["identification_number"] = $request["identification_number"];

            $data["item"]["custom_id"] = $request["external_reference"];
            $data["item"]["title"] = $request["title"];
            $data["item"]["currency_id"] = "ARS";
            $data["item"]["picture_url"] = null;
            $data["item"]["description"] = $request["title"];
            $data["item"]["category_id"] = "Others";
            $data["item"]["quantity"] = 1;
            $data["item"]["unit_price"] = $request["unit_price"];

            $data["back_urls"]["success"] = null;
            $data["back_urls"]["pending"] = null;
            $data["back_urls"]["failure"] = null;

            $itemCollection->code = $request["external_reference"];
            $itemCollection->link = $this->preferenceRepository->get_link( $data, auth()->user() );
            $itemCollection->link_error = null;

            $collectionReturn->push( $itemCollection );
        }

        return response()
            ->json( $collectionReturn )
            ->setStatusCode(200 )
            ->setEncodingOptions(JSON_NUMERIC_CHECK );
    }
}
