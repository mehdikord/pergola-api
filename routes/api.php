<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('colors',[\App\Http\Controllers\Public\PublicColorController::class,'colors'])->name('colors');
Route::get('colors/grouping',[\App\Http\Controllers\Public\PublicColorController::class,'colors_grouping'])->name('colors_grouping');

Route::get('options',[\App\Http\Controllers\Public\PublicColorController::class,'options'])->name('options');

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
