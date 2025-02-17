<?php

namespace App\Http\Controllers\Admins\Answer_Options;

use App\Http\Controllers\Controller;
use App\Http\Requests\Answer_Options\AnswerOptionsCreateRequest;
use App\Http\Requests\Answer_Options\AnswerOptionsUpdateRequest;
use App\Interfaces\Answer_Options\AnswerOptionInterface;
use App\Models\Answer_Option;

class AnswerOptionController extends Controller
{
    protected AnswerOptionInterface $repository;

    public function __construct(AnswerOptionInterface $answerOption)
    {
        $this->middleware('generate_fetch_query_params')->only('index');
        $this->repository = $answerOption;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->repository->index();
    }

    public function all()
    {
        return $this->repository->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnswerOptionsCreateRequest $request)
    {
        return $this->repository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer_Option $option)
    {
        return $this->repository->show($option);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AnswerOptionsUpdateRequest $request,Answer_Option $option)
    {
        return $this->repository->update($request,$option);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer_Option $option)
    {
        return $this->repository->destroy($option);
    }

    public function activation(Answer_Option $option)
    {
        return $this->repository->change_activation($option);

    }
}
