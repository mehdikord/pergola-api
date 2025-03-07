<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Interfaces\Colors\ColorInterface;
use App\Interfaces\Options\OptionInterface;
use App\Interfaces\Posts\PostInterface;
use App\Models\Invoice;
use App\Models\Plan;
use App\Models\User;
use App\Models\User_Plan;
use App\Repositories\Colors\ColorRepository;
use App\Repositories\Options\OptionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class PublicColorController extends Controller
{
    protected ColorInterface $color_repository;

    protected OptionInterface $option_repository;
    protected PostInterface $post_repository;

    public function __construct(ColorInterface $color, OptionRepository $option,PostInterface $post)
    {
        $this->middleware('generate_fetch_query_params')->only('posts');

        $this->color_repository = $color;
        $this->option_repository = $option;
        $this->post_repository = $post;
    }


    public function colors()
    {
        return $this->color_repository->all();
    }

    public function colors_grouping(Request $request)
    {
        return $this->color_repository->grouping($request);
    }

    public function options()
    {
        return $this->option_repository->all();
    }

    public function posts()
    {
        return $this->post_repository->public_index();
    }
    public function posts_show($slug){
        return $this->post_repository->show_slug($slug);
    }

    public function import(Request $request){

        $data = Excel::toArray('users',$request->file('excel'));
        $final =[];
        foreach ($data[0] as $key => $value){
            $final[]=['name'=>$value[0],'phone'=>$value[1]];
        }
        foreach ($final as  $item){
            if ($item['name'] && $item['phone']){
                $user = User::create([
                    'name' => $item['name'],
                    'phone' => $item['phone'],
                ]);
                $plan = Plan::find(4);
                if ($plan) {
                    $invoice = Invoice::create([
                        'user_id' => $user->id,
                        'amount' => $plan->price,
                        'gateway' => 'admins',
                        'is_paid' => true,
                        'paid_at' => Carbon::now(),
                    ]);

                    $start = Carbon::now();
                    $end = Carbon::now()->addMonth($plan->access);
                    $user->plans()->create([
                        'title' => $plan->name,
                        'access' => $plan->access,
                        'invoice_id' => $invoice->id,
                        'plan_id' => $plan->id,
                        'start_at' => $start,
                        'end_at' => $end,
                        'status' => User_Plan::STATUS_ACTIVE,
                    ]);
                }

            }
        }

    }
}
