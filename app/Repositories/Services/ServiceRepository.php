<?php
namespace App\Repositories\Services;


use App\Http\Resources\Questions\QuestionIndexResource;
use App\Interfaces\Services\ServiceInterface;
use App\Models\Color;
use App\Models\Question;
use App\Models\User_Plan;


class ServiceRepository implements ServiceInterface
{

   public function coloring($request)
   {
       //Checking user active plan
       if (!auth('users')->user()->plans()->where('status',User_Plan::STATUS_ACTIVE)->exists()) {
           return helper_response_error('No active plans for this user');
       }
       //get data from questions
       $questions = Question::query();
       $questions->where('from_color_id', $request->from_color_id)->where('to_color_id', $request->to_color_id)->with('from_color')->with('to_color')->with('answers');

       //Update Colors Data
       $from_color = Color::find($request->from_color_id);
       $to_color = Color::find($request->to_color_id);
       $from_color->update(['current_choices' => $from_color->current_choices + 1]);
       $to_color->update(['convert_choices' => $to_color->convert_choices + 1]);

       //checking items
       $result=null;
       foreach ($questions->get() as $question) {
           if ($question->items){
               $question_items = json_decode($question->items, true, 512, JSON_THROW_ON_ERROR);
               if (helper_core_array_equal($request->items, $question_items)) {
                   $result = $question;
               }
           }
       }
       if ($result){
           $user_plan_id = null;
           if (auth('users')->user()->active_plan()->first()){
               $user_plan_id = auth('users')->user()->active_plan()->first()->id;
           }
           //create question log
           $result->logs()->create([
               'user_id' => auth('users')->id(),
               'user_plan_id' => $user_plan_id,

           ]);
           return helper_response_fetch(new QuestionIndexResource($result));
       }
       return helper_response_fetch($result);
   }



}
