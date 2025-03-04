<?php

namespace App\Http\Controllers\Admins\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Dashboard\DashboardInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected DashboardInterface $repository;
    public function __construct(DashboardInterface $dashboard){
        $this->repository = $dashboard;
    }

    public function info_system()
    {
        return $this->repository->system_info();
    }

    public function info_colors()
    {
        return $this->repository->colors_info();

    }


}
