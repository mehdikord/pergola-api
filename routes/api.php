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
Route::get('colors/first',[\App\Http\Controllers\Public\PublicColorController::class,'first'])->name('first');
Route::get('colors/second/{color}',[\App\Http\Controllers\Public\PublicColorController::class,'second'])->name('second');
Route::get('colors/grouping',[\App\Http\Controllers\Public\PublicColorController::class,'colors_grouping'])->name('colors_grouping');

Route::get('options',[\App\Http\Controllers\Public\PublicColorController::class,'options'])->name('options');

Route::group(['prefix' => 'laravel-filemanager','middleware' => ['web', 'cors']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::get('post-categories',[\App\Http\Controllers\Public\PublicColorController::class,'post_categories'])->name('post_categories');

Route::prefix('posts')->group(function () {
    Route::get('{category}',[\App\Http\Controllers\Public\PublicColorController::class,'posts'])->name('posts');
    Route::get('show/{slug}',[\App\Http\Controllers\Public\PublicColorController::class,'posts_show'])->name('posts_show');
    Route::get('category/{category}',[\App\Http\Controllers\Public\PublicColorController::class,'posts_show_category'])->name('posts_show_category');
});
Route::prefix('pages')->group(function () {
    Route::get('/{slug}',[\App\Http\Controllers\Public\PublicColorController::class,'page_show'])->name('page_show');
});
//Route::post('import',[\App\Http\Controllers\Public\PublicColorController::class,'import'])->name('import');
