<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

//Homepage
Route::get('/', [PostController::class, 'index'])->name('home');
//Page d'article
Route::get('/posts/{post}', [PostController::class, 'show'])->name('post');
// Envoi du formulaire commentaire
Route::post('/comment', [CommentController::class, 'store'])->name('comment');

// DASHBOARD:

// Lister les posts
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Créer - enregistrer un nouveau post
Route::get('/createPost/', [DashboardController::class, 'create'])->middleware(['auth'])->name('createPost');
Route::post('/storePost/', [DashboardController::class, 'store'])->middleware(['auth'])->name('storePost');

// Modifier - sauvegarder un post
Route::get('/dashboard/{post}', [DashboardController::class, 'edit'])->middleware(['auth'])->name('editPost');
Route::put('/dashboard/{post}', [DashboardController::class, 'update'])->middleware(['auth'])->name('updatePost');

// Supprimer un post
Route::delete('/dashboard/{post}', [DashboardController::class, 'delete'])->middleware(['auth'])->name('deletePost');

// Modifier - sauvegarder un comment
Route::put('/dashboard/comment/{comment}', [CommentController::class, 'update'])->middleware(['auth'])->name('updateComment');

// Supprimer un post
Route::delete('/dashboard/comment/{comment}', [CommentController::class, 'delete'])->middleware(['auth'])->name('deleteComment');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('/register',[RegisteredUserController::class, 'create'])->name('register');
require __DIR__ . '/auth.php';
