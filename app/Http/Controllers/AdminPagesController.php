<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Hosting;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Post;


class AdminPagesController extends Controller
{
    public function goToDefault() { 
        return redirect()->route('admin.hostings');
    }
    public function hostings()
    {
        $hostings = new Hosting();

        return view('admin.hostings', ['hostings' => $hostings->all()]);
    }
    public function createNewHosting()
    {
        return view('admin.createNewHosting');
    }
    public function editHosting($id)
    {
        Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:hostings,id'
        ])->validate();

        $hosting = Hosting::find($id);

        return view('admin.editHosting', ['hosting' => $hosting]);
    }
    public function posts()
    {
        $posts = Post::orderByDesc('updated_at')->get();

        return view('admin.posts', ['posts' => $posts]);
    }
    public function createNewPost()
    {
        return view('admin.createNewPost');
    }
    public function editPost($title)
    {
        Validator::make(['slug' => $title], [
            'slug' => 'required|string|exists:posts,slug'
        ])->validate();

        $post = Post::where('slug', $title)->first();

        return view('admin.editPost', ['post' => $post]);
    }
    public function settings()
    {
        $settings = Setting::first();

        return view('admin.settings', ['settings' => $settings]);
    }
}
