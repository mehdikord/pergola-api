<?php

namespace App\Interfaces\Posts;

interface PostInterface
{
    public function index();

    public function store($request);

    public function show($item);

    public function update($request,$item);

    public function destroy($item);

    public function change_activation($item);

    public function update_image($request,$item);

    public function public_index();

    public function show_slug($item);

}
