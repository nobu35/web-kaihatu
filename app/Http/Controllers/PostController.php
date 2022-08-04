<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    //
    public function create()
    {
        $posts = Post::all();
        $users = User::all();
        return view('post/create',compact('posts','users'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Post::query();
        $users = User::all();

        if(!empty($keyword)) {
            $query->where('content', 'LIKE', "%{$keyword}%")
                ->orWhere('tag', 'LIKE', "%{$keyword}%");
        }

        $posts = $query->get();

        return view('post/search',compact('posts','keyword','users'));
    }


    public function store(Request $request)
    {
        $img = $request->file('img_path');
        $path = $img->store('img','public');
        $id = Auth::id();

        $post = new Post;
        $post->user_id = $id;
        $post->img_path = $path;
        $post->tag = $request->tag;
        $post->content = $request->content;
        $post->save();
        return redirect()->route('post.create');
    }
}

