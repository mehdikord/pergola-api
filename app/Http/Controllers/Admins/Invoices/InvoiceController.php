<?php

namespace App\Http\Controllers\Admins\Invoices;

use App\Http\Controllers\Controller;
use App\Interfaces\Invoices\InvoiceInterface;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected InvoiceInterface $repository;
    public function __construct(InvoiceInterface $invoice){
        $this->repository = $invoice;
    }

    public function index()
    {
        return $this->repository->index();
    }
}
