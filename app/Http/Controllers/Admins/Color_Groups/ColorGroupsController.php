<?php

namespace App\Http\Controllers\Admins\Color_Groups;

use App\Http\Controllers\Controller;
use App\Http\Requests\Color_Groups\ColorGroupUpdateRequest;
use App\Http\Requests\Color_Groups\ColorsGroupCreateRequest;
use App\Interfaces\Color_Groups\ColorGroupInterface;
use App\Models\Color_Group;

class ColorGroupsController extends Controller
{
    protected ColorGroupInterface $repository;

    public function __construct(ColorGroupInterface $group)
    {
        $this->middleware('generate_fetch_query_params')->only('index');
        $this->repository = $group;
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
    public function store(ColorsGroupCreateRequest $request)
    {
        return $this->repository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Color_Group $group)
    {
        return $this->repository->show($group);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ColorGroupUpdateRequest $request,Color_Group $group)
    {
        return $this->repository->update($request,$group);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color_Group $group)
    {
        return $this->repository->destroy($group);
    }

}
