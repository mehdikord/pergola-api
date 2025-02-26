<?php

namespace App\Interfaces\Questions;

interface QuestionInterface
{
    public function index();

    public function store($request);

    public function show($item);

    public function update($request,$item);

    public function destroy($item);

    public function change_activation($item);

    public function uploader($request);

    public function users_store($request);

    public function users_get();

    public function users_destroy($item);

}
