<?php

namespace App\Http\Controllers\Admins\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\PostsCreateRequest;
use App\Http\Requests\Posts\PostsImageUpdateRequest;
use App\Http\Requests\Posts\PagesUpdateRequest;
use App\Interfaces\Posts\PostInterface;
use App\Models\Color;
use App\Models\Post;

class PostController extends Controller
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
        return $this->repository->index();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PostsCreateRequest $request)
    {
        return $this->repository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return $this->repository->show($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PagesUpdateRequest $request, Post $post)
    {
        return $this->repository->update($request,$post);
    }

    public function update_image(PostsImageUpdateRequest $request,Color $color)
    {
        return $this->repository->update_image($request,$color);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        return $this->repository->destroy($post);
    }

    public function activation(Post $post)
    {
        return $this->repository->change_activation($post);

    }
}
