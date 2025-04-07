<?php

namespace App\Http\Controllers\Admins\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\PagesCreateRequest;
use App\Http\Requests\Pages\PagesUpdateRequest;
use App\Interfaces\Pages\PageInterface;
use App\Models\Color;
use App\Models\Page;

class PageController extends Controller
{
    protected PageInterface $repository;

    public function __construct(PageInterface $page)
    {
        $this->middleware('generate_fetch_query_params')->only('index');
        $this->repository = $page;
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
    public function store(PagesCreateRequest $request)
    {
        return $this->repository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return $this->repository->show($page);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PagesUpdateRequest $request,Page $page)
    {
        return $this->repository->update($request,$page);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        return $this->repository->destroy($page);
    }

}
