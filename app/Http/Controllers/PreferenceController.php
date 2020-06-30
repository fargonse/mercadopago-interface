<?php

namespace App\Http\Controllers;

use App\Http\Requests\PreferenceRequest;
use App\Models\Preference;
use App\Models\User;
use App\Repositories\Interfaces\PreferenceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MercadoPago;

class PreferenceController extends Controller
{
    /**
     *
     * @var PreferenceRepositoryInterface
     *
     */
    private $repository;

    public function __construct(PreferenceRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(PreferenceRequest $request)
    {
        $preference = $this->repository->create( $request->all(), auth()->user() );

        return response()
            ->json( $preference )
            ->setStatusCode(200 )
            ->setEncodingOptions(JSON_NUMERIC_CHECK );
    }

}
