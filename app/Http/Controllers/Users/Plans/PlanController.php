<?php

namespace App\Http\Controllers\Users\Plans;

use App\Http\Controllers\Controller;
use App\Interfaces\Plans\PlanInterface;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    protected PlanInterface $repository;

    public function __construct(PlanInterface $plan){
        $this->repository = $plan;
    }

    public function index()
    {
        return $this->repository->users_all();
    }
    public function active()
    {
        return $this->repository->users_active();
    }
}
