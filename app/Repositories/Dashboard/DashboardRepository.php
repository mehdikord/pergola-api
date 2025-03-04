<?php
namespace App\Repositories\Dashboard;

use App\Interfaces\Dashboard\DashboardInterface;
use App\Models\Color;
use App\Models\Question_Log;
use App\Models\User;
use App\Models\User_Plan;


class DashboardRepository implements DashboardInterface
{
    public function system_info()
    {
        $users = User::count();
        $users_actives = User::whereHas('plans', function ($query) {
            $query->where('status', User_Plan::STATUS_ACTIVE);
        })->count();
        $questions = Question_Log::count();
        $colors = Color::count();
        return helper_response_fetch([
            'users' => $users,
            'questions' => $questions,
            'colors' => $colors,
            'users_actives' => $users_actives,
        ]);
    }

    public function colors_info(){
        $from_colors = Color::orderByDesc('current_choices')->take(5)->get();
        $to_colors = Color::orderByDesc('convert_choices')->take(5)->get();
        return helper_response_fetch(['from_colors' => $from_colors, 'to_colors' => $to_colors]);
    }
}
