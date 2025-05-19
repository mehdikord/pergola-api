<?php

namespace App\Interfaces\Posts;

interface PostInterface
{
    public function index();
    public function category_index();
    public function category_all();

    public function store($request);
    public function category_store($request);

    public function show($item);
    public function category_show($item);

    public function update($request,$item);
    public function category_update($request,$item);

    public function destroy($item);
    public function category_destroy($item);

    public function change_activation($item);

    public function update_image($request,$item);

    public function public_index($category);

    public function show_slug($item);

}
