<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

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
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function store(Request $request)
    {
        // Valider tes champs : https://laravel.com/docs/9.x/validation#validation-quickstart avec les règles de validation : https://laravel.com/docs/9.x/validation#available-validation-rules

        if (auth()->user()) {
            $validate = $request->validate([
                'post_id' => 'exists:App\Models\Post,id',
                'user_id' => ['required', 'exists:App\Models\User,id'],
                'content' => ['required', 'string']
            ]);
        } else {
            $validate = $request->validate([
                'post_id' => 'exists:App\Models\Post,id',
                'pseudo' => ['required', 'string'],
                'email' => ['required', 'email:rfc,dns'],
                'content' => ['required', 'string']
            ]);
        }
        print_r($validate);

        $comment = new Comment;
        $comment->post_id = $request->post_id;
        $comment->user_id = $request->user_id;
        $comment->pseudo = $request->pseudo;
        $comment->email = $request->email;
        $comment->content = $request->content;
        $comment->save();
    }

    // Crée un comment via un model : https://laravel.com/docs/9.x/eloquent#inserts

    // Redirige ou renvoi sur une view success : https://laravel.com/docs/9.x/responses#redirects


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Post $post)
    {
        $post->load(['comments.user', 'user']);

        return view('post', ['post' => $post]);
    }
}
