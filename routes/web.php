<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\APIPostController;
use App\Http\Controllers\API\APICommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// CRUD INVITÉ - UTILISATEUR
Route::get('/', [PostController::class, 'index'])->name('home');
//Page d'article
Route::get('/posts/{post}', [PostController::class, 'show'])->name('post');
// Envoi du formulaire commentaire
Route::post('/comment', [CommentController::class, 'store'])->name('comment');


// CRUD ADMIN:
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], (function () {
// Lister les posts
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Créer - enregistrer un nouveau post
    Route::get('/post/create', [DashboardController::class, 'create'])->name('createPost');
    Route::post('/post/store', [DashboardController::class, 'store'])->name('storePost');

// Modifier - sauvegarder un post
    Route::get('/{post}', [DashboardController::class, 'edit'])->name('editPost');
    Route::put('/{post}', [DashboardController::class, 'update'])->name('updatePost');

// Supprimer un post
    Route::delete('/{post}', [DashboardController::class, 'delete'])->name('deletePost');

// Modifier - sauvegarder un commentaire
    Route::put('/comment/{comment}', [CommentController::class, 'update'])->name('updateComment');

// Supprimer un commentaire
    Route::delete('/comment/{comment}', [CommentController::class, 'delete'])->name('deleteComment');
}));


//js
Route::view('/js/', 'scripted.index')->name('JShome');
Route::view('/js/posts/{post}', 'scripted.post')->name('JSPost');

require __DIR__ . '/auth.php';
