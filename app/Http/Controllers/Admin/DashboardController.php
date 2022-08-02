<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function index()
    {
        $posts = Post::with('user')->withCount('comments')->latest()->paginate();
        return view('admin.dashboard', ['posts' => $posts]);
    }

    //OK
    public function create()
    {
        return view('createPost');
    }

    public function store(Request $request)
    {
        $rules = [
            'post_title' => ['required', 'string', 'max:500'],
            'post_content' => ['required', 'string', 'max:2000'],
        ];
        $validated = $request->validate($rules);

        $post = new Post;
        $user_id = Auth::user()->id;
        $post->user_id = $user_id;
        $post->title = $validated['post_title'];
        $post->content = $validated['post_content'];
        $post->save();
        return redirect('admin.dashboard');
    }


    public function edit(Post $post)
    {
        $post->load(['comments.user', 'user']);
        return view('admin.editPost', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'post_id' => 'required|exists:App\Models\Post,id',
            'post_title' => ['required', 'string', 'max:500'],
            'post_content' => ['required', 'string', 'max:2000'],
        ];
        $validated = $request->validate($rules);

        $post->id = $validated['post_id'];
        $post->title = $validated['post_title'];
        $post->content = $validated['post_content'];
        $post->save();
        return redirect('admin.dashboard');
    }

    public function delete(Post $post)
    {
        $post->comments()->delete();
        $post->delete();
        return redirect('admin.dashboard');
    }
}
