<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    //OK
    public function index()
    {
        $posts = Post::with('user')->withCount('comments')->latest()->paginate();
        return view('dashboard', ['posts' => $posts]);
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
        //$post->user = User::on('id');
        $user_id = Auth::user()->id;
        $post->user_id = $user_id;
        $post->title = $validated['post_title'];
        $post->content = $validated['post_content'];
        $post->save();

        return redirect('dashboard');
    }

    // OK
    public function edit(Post $post)
    {
        $post->load(['comments.user', 'user']);
        return view('editPost', ['post' => $post]);
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

        // Modifier le post via le model
        print_r($post);
        $post->save();

        return redirect('dashboard');
    }

    public function delete(Request $request, Post $post)
    {
        $post->delete();
        return redirect('dashboard');
    }
}
