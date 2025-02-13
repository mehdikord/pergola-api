<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Repositories\Colors\ColorRepository;
use App\Repositories\Options\OptionRepository;
use Illuminate\Http\Request;

class PublicColorController extends Controller
{
    protected ColorRepository $color_repository;

    protected OptionRepository $option_repository;

    public function __construct(ColorRepository $color, OptionRepository $option)
    {
        $this->color_repository = $color;
        $this->option_repository = $option;
    }


    public function colors()
    {
        return $this->color_repository->all();
    }

    public function options()
    {
        return $this->option_repository->all();
    }
}
