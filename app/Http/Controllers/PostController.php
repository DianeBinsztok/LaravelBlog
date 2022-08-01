<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = Post::with('user')->withCount('comments')->latest()->paginate();

        return view('index', ['posts' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */
    public function store(Request $request)
    {
        // Valider les champs : https://laravel.com/docs/9.x/validation#validation-quickstart avec les règles de validation : https://laravel.com/docs/9.x/validation#available-validation-rules
        if (Auth::check()) {
            $rules = [
                'post_id' => 'required|exists:App\Models\Post,id',
                'content' => ['required', 'string', 'max:2000'],
            ];
        } else {
            $rules = [
                'post_id' => 'required|exists:App\Models\Post,id',
                'pseudo' => ['required', 'string'],
                'email' => ['required', 'email'],
                'content' => ['required', 'string', 'max:2000'],
            ];
        }

        $validate = $request->validate($rules);

        // Crée un comment via un model : https://laravel.com/docs/9.x/eloquent#inserts
        $comment = new Comment;
        $comment->post_id = $validate['post_id'];
        $comment->content = $validate['content'];

        if (Auth::check()) {
            $comment->user_id = Auth::id();
        } else {
            $comment->pseudo = $validate['pseudo'];
            $comment->email = $validate['email'];
        }

        $comment->save();

        // Redirige ou renvoie sur une view success : https://laravel.com/docs/9.x/responses#redirects
        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Post $post)
    {
        $post->load(['comments.user', 'user']);

        return view('post', ['post' => $post]);
    }
}
