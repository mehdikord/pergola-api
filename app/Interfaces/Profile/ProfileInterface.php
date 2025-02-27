<?php

namespace App\Interfaces\Profile;


interface ProfileInterface
{
    public function index();

    public function update($request);

    public function invoices();

    public function invoices_show($item);

}
