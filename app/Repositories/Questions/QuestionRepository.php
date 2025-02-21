<?php
namespace App\Repositories\Questions;

use App\Http\Resources\Questions\QuestionIndexResource;
use App\Interfaces\Questions\QuestionInterface;
use App\Models\Question;
use Illuminate\Support\Facades\Storage;

class QuestionRepository implements QuestionInterface
{

   public function index()
   {
       $data = Question::query();
       $data->orderBy(request('sort_by'),request('sort_type'));
       return helper_response_fetch(QuestionIndexResource::collection($data->paginate(request('per_page')))->resource);
   }

   public function store($request)
   {
       $items = null;
       if (is_array($request->items)) {
           $items = json_encode($request->items, JSON_THROW_ON_ERROR);
       }
       $data = Question::create([
           'from_color_id' => $request->from_color_id,
           'to_color_id' => $request->to_color_id,
           'items' => $items,
           'is_active' => true
       ]);
       if (is_array($request->answers)) {
           foreach ($request->answers as $answer) {
               $get_answer = null;
               if ($answer){
                   $get_answer = json_encode($answer, JSON_THROW_ON_ERROR);
               }
               $data->answers()->create([
                   'answer' => $get_answer,
               ]);
           }
       }

       return helper_response_fetch(new QuestionIndexResource($data));
   }

   public function show($item)
   {
       return helper_response_fetch(new QuestionIndexResource($item));
   }

   public function update($request, $item)
   {

       $items = $item->items;
       if (is_array($request->items)) {
           $items = json_encode($request->items, JSON_THROW_ON_ERROR);
       }


        $item->update([
           'from_color_id' => $request->from_color_id,
           'to_color_id' => $request->to_color_id,
           'items' => $items,
       ]);
       if (is_array($request->answers)) {
           $item->answers()->delete();
           foreach ($request->answers as $answer) {
               $get_answer = null;
               if ($answer){
                   $get_answer = json_encode($answer, JSON_THROW_ON_ERROR);
               }
               $item->answers()->create([
                   'answer' => $get_answer,
               ]);
           }
       }

       return helper_response_fetch(new QuestionIndexResource($item));
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

   public function uploader($request)
   {
       if ($request->hasFile('file')) {
           $path = $request->file('file')->store('attachments/questions', 'public');
           $url = Storage::disk('public')->url($path);
           return response()->json(['location' => $url]);
       }

   }


}
