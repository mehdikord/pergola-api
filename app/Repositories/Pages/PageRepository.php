<?php
namespace App\Repositories\Pages;

use App\Http\Resources\Pages\PageIndexResource;
use App\Interfaces\Pages\PageInterface;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;
use App\Traits\Searching\AdvanceSearchingTrait;


class PageRepository implements PageInterface
{
    use AdvanceSearchingTrait;

   public function index()
   {
       $data = Page::query();

       $data->orderBy(request('sort_by'),request('sort_type'));
       return helper_response_fetch(PageIndexResource::collection($data->paginate(request('per_page')))->resource);
   }

    public function store($request)
   {
       $data = Page::create([
           'title' => $request->title,
           'slug' => $request->slug,
           'content' => $request->content,
       ]);
       return helper_response_fetch(new PageIndexResource($data));
   }

   public function show($item)
   {
       return helper_response_fetch(new PageIndexResource($item));
   }

   public function update($request, $item)
   {
       $data = $item->update([
           'title' => $request->title,
           'slug' => $request->slug,
           'content' => $request->content,
       ]);
       return helper_response_fetch(new PageIndexResource($item));
   }

   public function destroy($item)
   {
       $item->delete();
       return helper_response_deleted();
   }

   public function show_slug($item){
       $page = Page::query()->where('slug',$item)->first();
       if ($page){
           return helper_response_fetch(new PageIndexResource($page));
       }
       return [];
   }


}
