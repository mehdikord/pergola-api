<?php

use Illuminate\Support\Facades\Route;
//All Admins Routing

Route::prefix('auth')->group(function () {

    Route::post('login',[\App\Http\Controllers\Admins\Auth\AuthController::class, 'login'])->name('login');

});

//Enable middleware

Route::middleware('auth:admins')->group(function () {

    Route::prefix('users')->as('users.')->group(function () {
        Route::get('{user}/activation',[\App\Http\Controllers\Admins\Users\UserController::class, 'activation'])->name('activation');
    });

    Route::apiResource('users',\App\Http\Controllers\Admins\Users\UserController::class);

    //Colors
    Route::prefix('colors')->as('colors.')->group(function () {
        Route::get('all',[\App\Http\Controllers\Admins\Colors\ColorController::class, 'all'])->name('all');
        Route::get('{color}/activation',[\App\Http\Controllers\Admins\Colors\ColorController::class, 'activation'])->name('activation');
    });
    Route::apiResource('colors',\App\Http\Controllers\Admins\Colors\ColorController::class);

    //Options
    Route::prefix('options')->as('options.')->group(function () {
        Route::get('all',[\App\Http\Controllers\Admins\Options\OptionController::class, 'all'])->name('all');
        Route::get('{option}/activation',[\App\Http\Controllers\Admins\Options\OptionController::class, 'activation'])->name('activation');
    });

    Route::apiResource('options',\App\Http\Controllers\Admins\Options\OptionController::class);


    //Questions
    Route::prefix('questions')->as('questions.')->group(function () {
        Route::get('{question}/activation',[\App\Http\Controllers\Admins\Questions\QuestionController::class, 'activation'])->name('activation');
    });

    Route::apiResource('questions',\App\Http\Controllers\Admins\Questions\QuestionController::class);





});

?>
