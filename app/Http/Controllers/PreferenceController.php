<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {

    }
}
