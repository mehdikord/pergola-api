<?php

namespace App\Interfaces\Plans;

interface PlanInterface
{
    public function index();

    public function all();
    public function users_all();

    public function store($request);

    public function show($item);

    public function update($request,$item);

    public function destroy($item);

    public function change_activation($item);

    //Users Functions

    public function users_active();

}
