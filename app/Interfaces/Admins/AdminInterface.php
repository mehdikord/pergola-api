<?php

namespace App\Interfaces\Admins;

interface AdminInterface
{
    public function index();

    public function store($request);

    public function show($item);

    public function update($request,$item);
    public function change_password($request,$item);

    public function destroy($item);

    public function change_activation($item);

}
