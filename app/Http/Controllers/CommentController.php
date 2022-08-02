<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
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


    public function update(Request $request, Comment $comment)
    {
        $rules = [
            'post_id' => 'required|exists:App\Models\Post,id',
            'comment_content' => ['required', 'string', 'max:2000'],
        ];
        $validated = $request->validate($rules);

        $comment->post_id = $validated['post_id'];
        $comment->content = $validated['comment_content'];

        $comment->save();
        // Redirige ou renvoie sur une view success : https://laravel.com/docs/9.x/responses#redirects
        return back()->withInput();
    }

    public function delete(Comment $comment)
    {
        $comment->delete();
        $post_id = $comment->post_id;
        $post = Post::findOrFail($post_id);
        return view('editPost', ['post' => $post]);
    }

}
