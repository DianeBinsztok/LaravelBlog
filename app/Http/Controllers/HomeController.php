<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        /*
        $posts = DB::table('posts')
            ->orderBy('created_at', 'desc')
            ->join('users', 'id', '=', 'posts.user_id')
            ->select('name', 'pseudo')
            ->get();
        */

        $posts = Post::orderBy('created_at', 'desc')->paginate(10);


        //$posts = DB::table('posts')->select('title', 'created_at', 'user_id', 'content')->get();

        return view('index', ['posts' => $posts]);
    }
}
