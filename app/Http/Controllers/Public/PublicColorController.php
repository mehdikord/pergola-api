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

        $users = User::where('id','>',10)->get();
        foreach ($users as $user){
            $user->update(['phone' => '0'.$user->phone]);
        }
        return 'done';

    }
}
