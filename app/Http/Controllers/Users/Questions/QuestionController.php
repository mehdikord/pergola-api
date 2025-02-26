<?php

namespace App\Http\Controllers\Users\Questions;

use App\Http\Controllers\Controller;
use App\Interfaces\Questions\QuestionInterface;
use App\Models\User_Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected QuestionInterface $repository;
    public function __construct(QuestionInterface $question){
        $this->middleware('generate_fetch_query_params')->only('index');
        $this->repository = $question;
    }

    public function store(Request $request)
    {
        return $this->repository->users_store($request);
    }

    public function index()
    {
        return $this->repository->users_get();
    }

    public function destroy(User_Question $question)
    {
        return $this->repository->users_destroy($question);

    }


}
