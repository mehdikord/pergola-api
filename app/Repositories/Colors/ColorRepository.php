<?php
namespace App\Repositories\Colors;

use App\Http\Resources\Colors\ColorIndexResource;
use App\Http\Resources\Colors\ColorShortResource;
use App\Interfaces\Colors\ColorInterface;
use App\Models\Color;
use Illuminate\Support\Facades\Storage;

class ColorRepository implements ColorInterface
{

   public function index()
   {
       $data = Color::query();
       $data->orderBy(request('sort_by'),request('sort_type'));
       return helper_response_fetch(ColorIndexResource::collection($data->paginate(request('per_page')))->resource);
   }

    public function all()
    {
        $data = Color::query();
        $data->orderByDesc('id');
        return helper_response_fetch(ColorShortResource::collection($data->get()));
    }


    public function store($request)
   {
       $image = null;
       if ($request->hasFile('image')) {
           $path = $request->file('image')->store('attachments/colors/images', 'public');
           $image = Storage::disk('public')->url($path);
       }
       $data = Color::create([
           'color_group_id' => $request->color_group_id,
           'name' => $request->name,
           'image' => $image,
           'color' => $request->color,
           'description' => $request->description,
           'is_active' => true,

       ]);
       return helper_response_fetch(new ColorIndexResource($data));
   }

    public function update_image($request,$item)
    {
        $image = $item->color;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('attachments/colors/images', 'public');
            $image = Storage::disk('public')->url($path);
        }else{
            if ($image){
                Storage::disk('public')->delete($image);
            }
            $image = null;
        }
        $item->update(['image' => $image]);
        return helper_response_fetch(new ColorIndexResource($item));
    }
   public function show($item)
   {
       return helper_response_fetch(new ColorIndexResource($item));
   }

   public function update($request, $item)
   {
       $data = $item->update([
           'color_group_id' => $request->color_group_id,
           'name' => $request->name,
           'color' => $request->color,
           'description' => $request->description,
       ]);
       return helper_response_fetch(new ColorIndexResource($item));
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
