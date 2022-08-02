<?php

namespace App\Http\Controllers\API;

use Illuminate\Contracts\Support\Jsonable;
use App\Http\Controllers\Controller;
use App\Models\Post;

class APIPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = Post::with('user')->withCount('comments')->latest()->paginate();
        return $posts->toJson();
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
        return $post->toJson();
    }
}
