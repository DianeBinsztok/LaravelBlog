<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| js Routes
|--------------------------------------------------------------------------
*/

//Route::view('/js/', 'scripted.index')->name('JShome');

Route::get('/js/', function () {
    return view('scripted.index');
})->name('JShome');

Route::view('/js/posts/{post}', 'scripted.post')->name('JSPost');
Route::post('/js/comment', route('comment'))->name('JSComment');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
