<?php
namespace App\Repositories\Colors;

use App\Http\Resources\Colors\ColorIndexResource;
use App\Http\Resources\Colors\ColorShortResource;
use App\Interfaces\Colors\ColorInterface;
use App\Models\Color;
use Illuminate\Support\Facades\Storage;
use App\Traits\Searching\AdvanceSearchingTrait;


class ColorRepository implements ColorInterface
{
    use AdvanceSearchingTrait;

   public function index()
   {
       $data = Color::query();
       $this->advance_search($data);

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

    public function grouping($request)
    {
        $data = Color::query()->with('group');

        if ($request->filled('name')) {
            $data->where('name', 'like', '%'.$request->name.'%');
        }

        $result = [];
        foreach ($data->get() as $color) {
            $groupName = $color->group ? $color->group->name : 'تک رنگ ها';
            $result[$groupName][] = new ColorShortResource($color);
        }

        // تابع مقایسه برای مرتب‌سازی
        $compareByActive = function($a, $b) {
            if ($a['is_active'] === $b['is_active']) return 0;
            return ($a['is_active'] > $b['is_active']) ? -1 : 1;
        };

        // مرتب‌سازی هر گروه با مرجع
        foreach ($result as &$categoryItems) {
            usort($categoryItems, $compareByActive);
        }

        return helper_response_fetch($result);
    }

    public function compareByActive($a, $b) {
        if ($a['is_active'] == $b['is_active']) {
            return 0;
        }
        return ($a['is_active'] > $b['is_active']) ? -1 : 1;
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

   public function first()
   {
       //get from_colors
       $actives=[];
       $inactives=[];
       $from_color = Color::where('is_active',true)->whereHas('from_colors')->pluck('id');
       $get_from = Color::whereIn('id',$from_color)->get();
       $others = Color::whereNotIn('id',$from_color)->get();
       foreach ($get_from as $color) {
           $actives[] = $color;
       }
       foreach ($others as $other) {
           $inactives[] = $other;
       }
       $result = [
           'actives' => ColorShortResource::collection($actives),
           'inactives' => ColorShortResource::collection($inactives),
       ];

       return helper_response_fetch($result);
   }

   public function second($color)
   {
       //get from_colors
       $actives=[];
       $inactives=[];
       $from_color = $color->from_colors()->pluck('to_color_id');
       $get_from = Color::whereIn('id',$from_color)->get();
       $others = Color::whereNotIn('id',$from_color)->get();
       foreach ($get_from as $item) {
           $actives[] = $item;
       }
       foreach ($others as $other) {
           $inactives[] = $other;
       }
       $result = [
           'actives' => ColorShortResource::collection($actives),
           'inactives' => ColorShortResource::collection($inactives),
       ];

       return helper_response_fetch($result);
   }


}
