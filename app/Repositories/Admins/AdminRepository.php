<?php
namespace App\Repositories\Admins;

use App\Http\Resources\Admins\AdminIndexResource;
use App\Interfaces\Admins\AdminInterface;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminRepository implements AdminInterface
{

   public function index()
   {
       $data = Admin::query();
       $data->orderBy(request('sort_by'),request('sort_type'));
       return helper_response_fetch(AdminIndexResource::collection($data->paginate(request('per_page')))->resource);
   }

   public function store($request)
   {
       $data = Admin::create([
           'name' => $request->name,
           'phone' => $request->phone,
           'email' => $request->email,
           'password' => Hash::make($request->password),
           'is_active' => true,

       ]);
       return helper_response_fetch(new AdminIndexResource($data));
   }

   public function show($item)
   {
       return helper_response_fetch(new AdminIndexResource($item));
   }

   public function update($request, $item)
   {
       $data = $item->update([
           'name' => $request->name,
           'phone' => $request->phone,
           'email' => $request->email,
       ]);
       return helper_response_fetch(new AdminIndexResource($item));
   }

   public function change_password($request, $item)
   {
       $item->update(['password' => Hash::make($request->password)]);
       return helper_response_updated(new AdminIndexResource($item));
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


}
