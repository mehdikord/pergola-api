<?php

namespace App\Http\Controllers\Admins\Questions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Questions\QuestionsCreateRequest;
use App\Http\Requests\Questions\QuestionsUpdateRequest;
use App\Interfaces\Questions\QuestionInterface;
use App\Models\Question;

class QuestionController extends Controller
{
    protected QuestionInterface $repository;

    public function __construct(QuestionInterface $question)
    {
        $this->middleware('generate_fetch_query_params')->only('index');
        $this->repository = $question;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->repository->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionsCreateRequest $request)
    {
        return $this->repository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        return $this->repository->show($question);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionsUpdateRequest $request,Question $question)
    {
        return $this->repository->update($request,$question);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        return $this->repository->destroy($question);
    }

    public function activation(Question $question)
    {
        return $this->repository->change_activation($question);

    }
}
