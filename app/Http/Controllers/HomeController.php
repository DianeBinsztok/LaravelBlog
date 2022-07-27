<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $posts = Post::all();
        return view('index', ['posts' => $posts]);
    }
}
