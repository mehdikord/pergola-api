<?php
namespace App\Repositories\Posts;
use App\Http\Resources\Posts\PostCategoryIndexResource;
use App\Http\Resources\Posts\PostIndexResource;
use App\Interfaces\Posts\PostInterface;
use App\Models\Post;
use App\Models\Post_Category;
use Illuminate\Support\Facades\Storage;


class PostRepository implements PostInterface
{

   public function index()
   {
       $data = Post::query();
       $data->with('category');
       $data->orderBy(request('sort_by'),request('sort_type'));
       return helper_response_fetch(PostIndexResource::collection($data->paginate(request('per_page')))->resource);
   }

   public function category_index()
   {
       $data = Post_Category::query();
       $data->withCount('posts');
       $data->orderBy(request('sort_by'),request('sort_type'));
       return helper_response_fetch(PostCategoryIndexResource::collection($data->paginate(request('per_page')))->resource);
   }
   public function category_all()
   {
       $data = Post_Category::query();
       $data->withCount('posts');
       return helper_response_fetch(PostCategoryIndexResource::collection($data->get()));
   }

    public function store($request)
   {
       if ($request->filled('slug')){
           $request->merge(['slug' => strtolower(str_replace(' ', '-', $request->slug))]);
       }
       $image = null;
       if ($request->hasFile('image')) {
           $path = $request->file('image')->store('attachments/posts/images', 'public');
           $image = Storage::disk('public')->url($path);
       }
       $data = Post::create([
           'post_category_id' => $request->post_category_id,
           'title' => $request->title,
           'slug' => $request->slug,
           'description' => $request->description,
           'image' => $image,
           'is_active' => true,
       ]);
       $data->load('category');
       return helper_response_fetch(new PostIndexResource($data));
   }
    public function category_store($request)
   {

       $data = Post_Category::create([
           'name' => $request->name,
           'color' => $request->color,
           'description' => $request->description,

       ]);
       return helper_response_fetch(new PostCategoryIndexResource($data));
   }

   public function show($item)
   {
       return helper_response_fetch(new PostIndexResource($item));
   }
   public function category_show($item)
   {
       return helper_response_fetch($item);
   }

   public function update($request, $item)
   {
       $data = $item->update([
           'post_category_id' => $request->post_category_id,
           'title' => $request->title,
           'slug' => $request->slug,
           'description' => $request->description,
       ]);
       $item->load('category');
       return helper_response_fetch(new PostIndexResource($item));
   }

   public function category_update($request, $item)
   {
       $data = $item->update([
           'name' => $request->name,
           'color' => $request->color,
           'description' => $request->description,
       ]);
       $item->withCount('posts');
       return helper_response_fetch(new PostCategoryIndexResource($item));
   }

   public function destroy($item)
   {
       $item->delete();
       return helper_response_deleted();
   }
   public function category_destroy($item)
   {
       $item->delete();
       return helper_response_deleted();
   }

    public function change_activation($item)
   {
       $item->update(['is_active' => !$item->is_active]);
       return helper_response_updated([]);
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
        return helper_response_fetch(new PostIndexResource($item));
    }

    public function public_index($category)
    {
        $data = $category->posts();
        $data->where('is_active', true);
        $data->orderBy(request('sort_by'),request('sort_type'));
        return helper_response_fetch(PostIndexResource::collection($data->get()));
    }

    public function show_slug($item)
    {
        $data = Post::query()->where('slug', $item)->firstOrFail();
        return helper_response_fetch(new PostIndexResource($data));
    }

}
