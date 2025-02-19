<?php
namespace App\Repositories\Users;

use App\Http\Resources\Users\UserIndexResource;
use App\Interfaces\Users\UserInterface;
use App\Models\Invoice;
use App\Models\Plan;
use App\Models\User;
use App\Models\User_Plan;
use Illuminate\Support\Carbon;

class UserRepository implements UserInterface
{

   public function index()
   {
       $data = User::query();
       $data->with('plans' , function ($query) {
           $query->where('status', User_Plan::STATUS_ACTIVE)->get();
       });
       $data->orderBy(request('sort_by'),request('sort_type'));
       return helper_response_fetch(UserIndexResource::collection($data->paginate(request('per_page')))->resource);
   }

   public function store($request)
   {
       $data = User::create([
           'name' => $request->name,
           'phone' => $request->phone,
           'age' => $request->age,
           'is_active' => true,

       ]);
       return helper_response_fetch(new UserIndexResource($data));
   }

   public function show($item)
   {
       return helper_response_fetch(new UserIndexResource($item));
   }

   public function update($request, $item)
   {
       $data = $item->update([
           'name' => $request->name,
           'phone' => $request->phone,
           'age' => $request->age,
       ]);
       return helper_response_fetch(new UserIndexResource($item));
   }

   public function destroy($item)
   {
       $item->delete();
       return helper_response_deleted();
   }

   public function change_activation($item)
   {
       $item->update(['is_active' => !$item->is_active]);
       return helper_response_updated([]);
   }

   public function add_plan($request, $item)
   {
       $plan = Plan::find($request->plan_id);
       if ($plan) {
           $invoice = Invoice::create([
               'admin_id' => auth('admins')->id(),
               'user_id' => $item->id,
               'amount' => $plan->price,
               'gateway' => 'admins',
               'is_paid' => $request->invoice_status,
               'paid_at' => Carbon::now(),
               'description' => $request->description,
           ]);
           if ($item->plans()->where('status', User_Plan::STATUS_ACTIVE)->exists()) {
               $item->plans()->create([
                   'title' => $plan->name,
                   'access' => $plan->access,
                   'invoice_id' => $invoice->id,
                   'plan_id' => $plan->id,
                   'status' => User_Plan::STATUS_RESERVED,
               ]);
           }else{
               $start = Carbon::now();
               $end = Carbon::now()->addMonth($plan->access);
               $item->plans()->create([
                   'title' => $plan->name,
                   'access' => $plan->access,
                   'invoice_id' => $invoice->id,
                   'plan_id' => $plan->id,
                   'start_at' => $start,
                   'end_at' => $end,
                   'status' => User_Plan::STATUS_ACTIVE,
               ]);
           }
           return helper_response_created([]);
       }
       return helper_response_error('Plan not found');
   }

}
