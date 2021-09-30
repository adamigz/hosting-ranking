<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Hosting;
use App\Models\Post;

class PagesController extends Controller
{
    public function index()
    {
        $hostings = Hosting::orderByDesc('votes_count')->get();

        $recentPosts = Post::orderByDesc('created_at')->limit(5)->get();

        return view('home', ['hostings' => $hostings, 'recentPosts' => $recentPosts]);
    }
    public function hosting($id)
    {
        Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:hostings,id'
        ])->validate();

        $hosting = Hosting::find($id);
        
        return view('hosting', ['hosting' => $hosting]);
    }
    public function post($title)
    {
        Validator::make(['slug' => $title], [
            'slug' => 'required|string|exists:posts,slug'
        ])->validate();
        
        $post = Post::where('slug', $title)->first();

        return view('post', ['post' => $post]);
    }
    public function posts()
    {
        $posts = Post::all();

        return view('posts', ['posts' => $posts]);
    }
}

