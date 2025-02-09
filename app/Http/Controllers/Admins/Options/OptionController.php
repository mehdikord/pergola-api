<?php

namespace App\Http\Controllers\Admins\Options;

use App\Http\Controllers\Controller;
use App\Http\Requests\Options\OptionsCreateRequest;
use App\Http\Requests\Options\OptionsUpdateRequest;
use App\Interfaces\Options\OptionInterface;
use App\Models\Color;
use App\Models\Option;

class OptionController extends Controller
{
    protected OptionInterface $repository;

    public function __construct(OptionInterface $option)
    {
        $this->middleware('generate_fetch_query_params')->only('index');
        $this->repository = $option;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->repository->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OptionsCreateRequest $request)
    {
        return $this->repository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $option)
    {
        return $this->repository->show($option);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OptionsUpdateRequest $request,Option $option)
    {
        return $this->repository->update($request,$option);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        return $this->repository->destroy($option);
    }

    public function activation(Option $option)
    {
        return $this->repository->change_activation($option);

    }
}
