<?php
namespace App\Repositories\Plans;

use App\Http\Resources\Plans\PlanIndexResource;
use App\Http\Resources\Plans\PlanShortResource;
use App\Interfaces\Plans\PlanInterface;
use App\Models\Plan;

class PlanRepository implements PlanInterface
{

   public function index()
   {
       $data = Plan::query();
       $data->orderBy(request('sort_by'),request('sort_type'));
       return helper_response_fetch(PlanIndexResource::collection($data->paginate(request('per_page')))->resource);
   }

    public function all()
    {
        $data = Plan::query();
        $data->orderByDesc('id');
        return helper_response_fetch(PlanShortResource::collection($data->get()));
    }


    public function store($request)
   {
       $data = Plan::create([
           'name' => $request->name,
           'access' => $request->access,
           'price' => $request->price,
           'sale' => $request->sale,
           'description' => $request->description,
           'is_active' => true,
       ]);
       return helper_response_fetch(new PlanIndexResource($data));
   }

   public function show($item)
   {
       return helper_response_fetch(new PlanIndexResource($item));
   }

   public function update($request, $item)
   {
       $data = $item->update([
           'name' => $request->name,
           'access' => $request->access,
           'price' => $request->price,
           'sale' => $request->sale,
           'description' => $request->description,
       ]);
       return helper_response_fetch(new PlanIndexResource($item));
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
