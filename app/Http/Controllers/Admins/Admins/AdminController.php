<?php

namespace App\Http\Controllers\Admins\Admins;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\AdminCreateRequest;
use App\Http\Requests\Admins\AdminUpdatePasswordRequest;
use App\Http\Requests\Admins\AdminUpdateRequest;
use App\Interfaces\Admins\AdminInterface;

use App\Models\Admin;


class AdminController extends Controller
{
    protected AdminInterface $repository;

    public function __construct(AdminInterface $admin)
    {
        $this->middleware('generate_fetch_query_params')->only('index');
        $this->repository = $admin;
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
    public function store(AdminCreateRequest $request)
    {
        return $this->repository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        return $this->repository->show($admin);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUpdateRequest $request,Admin $admin)
    {
        return $this->repository->update($request,$admin);
    }

    public function change_password(AdminUpdatePasswordRequest $request,Admin $admin)
    {
        return $this->repository->change_password($request,$admin);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        return $this->repository->destroy($admin);
    }

    public function activation(Admin $admin)
    {
        return $this->repository->change_activation($admin);
    }

}
