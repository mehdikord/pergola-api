<?php

namespace App\Http\Controllers\Admins\Plans;

use App\Http\Controllers\Controller;
use App\Http\Requests\Plans\PlansCreateRequest;
use App\Http\Requests\Plans\PlansUpdateRequest;
use App\Interfaces\Plans\PlanInterface;
use App\Models\Plan;

class PlanController extends Controller
{
    protected PlanInterface $repository;

    public function __construct(PlanInterface $plan)
    {
        $this->middleware('generate_fetch_query_params')->only('index');
        $this->repository = $plan;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->repository->index();
    }

    public function all()
    {
        return $this->repository->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlansCreateRequest $request)
    {
        return $this->repository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        return $this->repository->show($plan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlansUpdateRequest $request,Plan $plan)
    {
        return $this->repository->update($request,$plan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        return $this->repository->destroy($plan);
    }

    public function activation(Plan $plan)
    {
        return $this->repository->change_activation($plan);

    }
}
