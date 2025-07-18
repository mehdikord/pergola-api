<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Interfaces\Colors\ColorInterface;
use App\Interfaces\Options\OptionInterface;
use App\Interfaces\Pages\PageInterface;
use App\Interfaces\Posts\PostInterface;
use App\Models\Color;
use App\Models\Invoice;
use App\Models\Plan;
use App\Models\Post_Category;
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

    protected PageInterface $page_repository;

    public function __construct(ColorInterface $color, OptionRepository $option,PostInterface $post,PageInterface $page)
    {
        $this->middleware('generate_fetch_query_params')->only('posts');

        $this->color_repository = $color;
        $this->option_repository = $option;
        $this->post_repository = $post;
        $this->page_repository = $page;
    }


    public function colors()
    {
        return $this->color_repository->all();
    }

    public function first()
    {
        return $this->color_repository->first();
    }

    public function second(Color  $color)
    {
        return $this->color_repository->second($color);
    }

    public function colors_grouping(Request $request)
    {
        return $this->color_repository->grouping($request);
    }

    public function options()
    {
        return $this->option_repository->all();
    }

    public function post_categories()
    {
        return $this->post_repository->category_all();
    }

    public function post_categories_parent()
    {
        return $this->post_repository->category_parent_all();
    }

    public function post_categories_children(Post_Category $category)
    {
        return $this->post_repository->category_children($category);

    }

    public function posts(Post_Category $category)
    {
        return $this->post_repository->public_index($category);
    }
    public function posts_show($slug){
        return $this->post_repository->show_slug($slug);
    }

    public function page_show($slug)
    {
        return $this->page_repository->show_slug($slug);
    }

    public function posts_show_category(Post_Category $category)
    {
        return $this->post_repository->category_show($category);
    }
}
