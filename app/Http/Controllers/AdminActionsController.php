<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Hosting;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;


class AdminActionsController extends Controller
{
    public function createNewHosting(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:20|string',
            'description' => 'required|string',
            'url' => 'required|url',
            'logo' => 'required|file',
            'desc' => 'string|nullable',
            'keywords' => 'string|nullable'
        ]);

        $hosting = Hosting::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'logo_path' => $request->file('logo')->store('logos') ?? '',
            'url' => $request->input('url'),
            'desc' => $request->input('desc') ?? '',
            'keywords' => $request->input('keywords') ?? ''
        ]);
        
        return redirect()->route('admin.hostings');
    }
    public function editHosting($id, Request $request)
    {
        Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:hostings,id'
        ])->validate();

        $hosting = Hosting::find($id);

        $validated = $request->validate([
            'name' => 'required|max:20|string',
            'description' => 'required|string',
            'url' => 'required|url',
            'desc' => 'string|nullable',
            'keywords' => 'string|nullable'
        ]);

        $temp_logo_path = $hosting->logo_path;
        
        $hosting->name = $request->input('name');
        $hosting->description = $request->input('description');
        $hosting->logo_path = $request->file('logo') ? $request->file('logo')->storePublicly('logos') : $hosting->logo_path;
        $hosting->url = $request->input('url');
        $hosting->desc = $request->input('desc') ?? '';
        $hosting->keywords = $request->input('keywords') ?? '';

        $hosting->logo_path == $temp_logo_path ? true : Storage::delete($temp_logo_path);

        $hosting->save();

        return redirect()->route('admin.hostings');
    }
    public function deleteHosting($id)
    {
        Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:hostings,id'
        ])->validate();

        $hosting = Hosting::find($id);

        Storage::delete($hosting->logo_path);

        $hosting->forceDelete();

        return redirect()->route('admin.hostings');
    }
    public function createNewPost(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'description' => 'string|nullable',
            'keywords' => 'string|nullable'
        ]);

        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'slug' => Str::slug($request->input('title')),
            'description' => $request->input('description') ?? '',
            'keywords' => $request->input('keywords') ?? ''
        ]);

        return redirect()->route('admin.posts');
    }
    public function editPost($title, Request $request)
    {
        Validator::make(['slug' => $title], [
            'slug' => 'required|string|exists:posts,slug'
        ])->validate();

        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'description' => 'string|nullable',
            'keywords' => 'string|nullable'
        ]);
        
        $post = Post::where('slug', $title)->first();

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->slug = Str::slug($request->input('title'));
        $post->description = $request->input('description') ?? '';
        $post->keywords = $request->input('keywords') ?? '';

        $post->save();
        
        return redirect()->route('admin.posts');
    }
    public function deletePost($id)
    {
        Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:posts,id'
        ])->validate();

        $post = Post::find($id);

        $post->forceDelete();

        return redirect()->route('admin.posts');
    }
    public function settings(Request $request)
    {
        $validated = $request->validate([
            'title' => 'string|required',
            'description' => 'string|nullable',
            'keywords' => 'string|nullable',
            'mail' => 'email|nullable'
        ]);

        $settings = Setting::first();

        $settings->title = $request->input('title');
        $settings->description = $request->input('description') ?? '';
        $settings->keywords = $request->input('keywords') ?? '';
        $settings->mail = $request->input('mail') ?? '';

        $settings->save();

        return redirect()->route('admin.settings', ['message' => 'Zapisano']);
    }
}
