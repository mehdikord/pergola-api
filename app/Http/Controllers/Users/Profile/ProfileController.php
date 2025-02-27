<?php

namespace App\Http\Controllers\Users\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserProfileUpdateRequest;
use App\Interfaces\Profile\ProfileInterface;
use App\Models\Invoice;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected ProfileInterface $repository;

    public function __construct(ProfileInterface $profile)
    {
        $this->repository = $profile;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function update(UserProfileUpdateRequest $request)
    {
        return $this->repository->update($request);
    }

    public function invoices()
    {
        return $this->repository->invoices();
    }

    public function invoices_show(Invoice $invoice)
    {
        return $this->repository->invoices_show($invoice);
    }
}
