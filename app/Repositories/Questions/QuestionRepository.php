<?php
namespace App\Repositories\Questions;

use App\Http\Resources\Questions\QuestionIndexResource;
use App\Interfaces\Questions\QuestionInterface;
use App\Models\Question;

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
       $data = Question::create([
           'from_color_id' => $request->from_color_id,
           'to_color_id' => $request->to_color_id,
           'items' => json_decode($request->items, false, 512, JSON_THROW_ON_ERROR),
           'is_active' => true
       ]);
       if (is_array($request->answers)) {
           foreach ($request->answers as $answer) {
               $data->answers()->create([
                   'answer' => $answer['answer'],
                   'is_special' => $answer['is_special'],
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
       $data = $item->update([
           'from_color_id' => $request->from_color_id,
           'to_color_id' => $request->to_color_id,
           'items' => json_decode($request->items, false, 512, JSON_THROW_ON_ERROR),
       ]);
       if (is_array($request->answers)) {
           $item->answers()->delete();
           foreach ($request->answers as $answer) {
               $data->answers()->create([
                   'answer' => $answer['answer'],
                   'is_special' => $answer['is_special'],
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


}
