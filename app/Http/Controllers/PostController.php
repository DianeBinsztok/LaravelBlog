<?php

namespace App\Http\Controllers;

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
        // Valider tes champs : https://laravel.com/docs/9.x/validation#validation-quickstart avec les règle de validation : https://laravel.com/docs/9.x/validation#available-validation-rules
        $validate = [];
        if (auth()) {
            $validate = $request->validate([
                'post_id' => 'exists:App\Models\Post,id',
                'user_id' => 'exists:App\Models\User,id',
                'email' => ['required', 'email:rfc,dns'],
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
        echo(implode($validate)); // pb avec le champs 'pseudo'-> renvoie 25 (??)


        // Crée un comment via un model : https://laravel.com/docs/9.x/eloquent#inserts

        // Redirige ou renvoi sur une view success : https://laravel.com/docs/9.x/responses#redirects
    }

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
