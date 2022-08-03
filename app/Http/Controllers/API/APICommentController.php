<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class APICommentController extends Controller
{

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

        //$comment->toJson();
        $comment->save();
        return response()->json($comment, 201);
    }
}
