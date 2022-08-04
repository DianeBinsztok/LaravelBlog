<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\APIPostController;
use App\Http\Controllers\API\APICommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/

Route::get('/posts', [APIPostController::class, 'index'])->name('APIhome');
Route::get('/posts/{post}', [APIPostController::class, 'show'])->name('APIPost');
Route::post('/comment', [APICommentController::class, 'store'])->name('APIComment');

//marche pas:
/*Route::apiResources([
    'post' => APIPostController::class,
    'comment' => APICommentController::class,
]);*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
