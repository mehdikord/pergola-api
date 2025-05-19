<?php

namespace App\Http\Controllers\Admins\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\PostsCategoryCreateRequest;
use App\Http\Requests\Posts\PostsCategoryUpdateRequest;
use App\Interfaces\Posts\PostInterface;
use App\Models\Post_Category;

class PostCategoryController extends Controller
{
    protected PostInterface $repository;

    public function __construct(PostInterface $post)
    {
        $this->middleware('generate_fetch_query_params')->only('index');
        $this->repository = $post;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->repository->category_index();
    }

    public function all()
    {
        return $this->repository->category_all();

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PostsCategoryCreateRequest $request)
    {
        return $this->repository->category_store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post_Category $category)
    {
        return $this->repository->category_show($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostsCategoryUpdateRequest $request, Post_Category $category)
    {
        return $this->repository->category_update($request,$category);
    }

    public function destroy(Post_Category $category)
    {
        return $this->repository->category_destroy($category);
    }

}
