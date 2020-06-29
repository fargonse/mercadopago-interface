<?php

namespace App\Http\Controllers;

use App\Http\Requests\PreferenceRequest;
use App\Repositories\Interfaces\PreferenceRepositoryInterface;
use Illuminate\Http\Request;

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
