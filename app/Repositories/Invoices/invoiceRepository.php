<?php
namespace App\Repositories\Invoices;

use App\Http\Resources\Invoices\InvoiceIndexResource;
use App\Http\Resources\Plans\PlanIndexResource;
use App\Interfaces\Invoices\InvoiceInterface;
use App\Models\Invoice;

class invoiceRepository implements InvoiceInterface
{

   public function index()
   {
       $data = Invoice::query();
       $data->orderBy(request('sort_by'),request('sort_type'));
       return helper_response_fetch(InvoiceIndexResource::collection($data->paginate(request('per_page')))->resource);
   }

}
