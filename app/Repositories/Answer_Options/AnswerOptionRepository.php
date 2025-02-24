<?php
namespace App\Repositories\Answer_Options;

use App\Http\Resources\Options\OptionIndexResource;
use App\Interfaces\Answer_Options\AnswerOptionInterface;
use App\Models\Option;

class AnswerOptionRepository implements AnswerOptionInterface
{

   public function index()
   {
       $data = Option::query();
       $data->orderBy(request('sort_by'),request('sort_type'));
       return helper_response_fetch(OptionIndexResource::collection($data->paginate(request('per_page')))->resource);
   }

    public function all()
    {
        $data = Option::query();
        $data->orderByDesc('id');
        return helper_response_fetch(OptionIndexResource::collection($data->get()));
    }

   public function store($request)
   {
       $data = Option::create([
           'name' => $request->name,
           'unit' => $request->unit,
           'guid' => $request->guid,
           'description' => $request->description,
           'is_active' => true,
       ]);
       if (is_array($request->items)){
           foreach ($request->items as $item){
               $data->items()->create([
                   'item' => $item['value'],
               ]);
           }
       }

       return helper_response_fetch(new OptionIndexResource($data));
   }

   public function show($item)
   {
       return helper_response_fetch(new OptionIndexResource($item));
   }

   public function update($request, $item)
   {
       $data = $item->update([
           'name' => $request->name,
           'unit' => $request->unit,
           'guid' => $request->guid,
           'description' => $request->description
       ]);
       if (is_array($request->items)){
           $item->items()->delete();
           foreach ($request->items as $get_item){
               $item->items()->create([
                   'item' => $get_item['value'],
               ]);
           }
       }
       $item->load('items');
       return helper_response_fetch(new OptionIndexResource($item));
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
