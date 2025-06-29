<?php

namespace App\Http\Controllers\Admins\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\PostsCreateRequest;
use App\Http\Requests\Posts\PostsImageUpdateRequest;
use App\Http\Requests\Posts\PostsUpdateRequest;
use App\Interfaces\Posts\PostInterface;
use App\Models\Color;
use App\Models\Post;
use App\Models\Post_File;
use Illuminate\Http\Request;

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
    public function update(PostsUpdateRequest $request, Post $post)
    {
        return $this->repository->update($request, $post);
    }

    public function update_image(PostsImageUpdateRequest $request, Color $color)
    {
        return $this->repository->update_image($request, $color);
    }

    public function remove_file(Post_File $file)
    {
        return $this->repository->remove_file($file);

    }

    public function add_file(Post $post, Request $request)
    {
        return $this->repository->add_file($post, $request);


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
