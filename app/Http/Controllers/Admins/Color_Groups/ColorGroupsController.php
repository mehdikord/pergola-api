<?php

namespace App\Http\Controllers\Admins\Color_Groups;

use App\Http\Controllers\Controller;
use App\Http\Requests\Colors\ColorsCreateRequest;
use App\Http\Requests\Colors\ColorsUpdateRequest;
use App\Interfaces\Color_Groups\ColorGroupInterface;
use App\Interfaces\Colors\ColorInterface;
use App\Models\Color;

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
    public function store(ColorsCreateRequest $request)
    {
        return $this->repository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        return $this->repository->show($color);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ColorsUpdateRequest $request,Color $color)
    {
        return $this->repository->update($request,$color);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        return $this->repository->destroy($color);
    }

}
