<?php

namespace App\Http\Controllers\Users\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Services\ServicesColoringCreateRequest;
use App\Interfaces\Services\ServiceInterface;
use App\Repositories\Services\ServiceRepository;
use Illuminate\Http\Request;

class ColoringController extends Controller
{

    protected ServiceInterface $repository;
    public function __construct(ServiceRepository $service)
    {
        $this->repository = $service;
    }

    public function coloring(ServicesColoringCreateRequest $request)
    {
        return $this->repository->coloring($request);
    }
}
