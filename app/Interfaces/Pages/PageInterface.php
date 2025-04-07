<?php

namespace App\Interfaces\Pages;

interface PageInterface
{
    public function index();

    public function store($request);

    public function show($item);

    public function update($request,$item);

    public function destroy($item);

    public function show_slug($item);


}
