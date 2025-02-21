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

}
