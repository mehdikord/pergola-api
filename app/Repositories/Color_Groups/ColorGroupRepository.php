<?php
namespace App\Repositories\Color_Groups;


use App\Http\Resources\Color_Groups\ColorGroupIndexResource;
use App\Http\Resources\Color_Groups\ColorGroupShortResource;
use App\Interfaces\Color_Groups\ColorGroupInterface;
use App\Models\Color_Group;

class ColorGroupRepository implements ColorGroupInterface
{

   public function index()
   {
       $data = Color_Group::query();
       $data->orderBy(request('sort_by'),request('sort_type'));
       return helper_response_fetch(ColorGroupIndexResource::collection($data->paginate(request('per_page')))->resource);
   }

    public function all()
    {
        $data = Color_Group::query();
        $data->orderByDesc('id');
        return helper_response_fetch(ColorGroupShortResource::collection($data->get()));
    }


    public function store($request)
   {
       $data = Color_Group::create([
           'name' => $request->name,
           'description' => $request->description,

       ]);
       return helper_response_fetch(new ColorGroupIndexResource($data));
   }

   public function show($item)
   {
       return helper_response_fetch(new ColorGroupIndexResource($item));
   }

   public function update($request, $item)
   {
       $data = $item->update([
           'name' => $request->name,
           'description' => $request->description,
       ]);
       return helper_response_fetch(new ColorGroupIndexResource($item));
   }

   public function destroy($item)
   {
       $item->delete();
       return helper_response_deleted();
   }



}
