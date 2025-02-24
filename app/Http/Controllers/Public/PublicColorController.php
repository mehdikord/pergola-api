<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Interfaces\Colors\ColorInterface;
use App\Interfaces\Options\OptionInterface;
use App\Repositories\Colors\ColorRepository;
use App\Repositories\Options\OptionRepository;
use Illuminate\Http\Request;

class PublicColorController extends Controller
{
    protected ColorInterface $color_repository;

    protected OptionInterface $option_repository;

    public function __construct(ColorInterface $color, OptionRepository $option)
    {
        $this->color_repository = $color;
        $this->option_repository = $option;
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
}
