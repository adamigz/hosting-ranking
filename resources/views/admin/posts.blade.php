@extends('layouts.app')

@section('title')
    {{ settings()->title }}
@endsection

@section('description')
    {{ settings()->description }}
@endsection

@section('keywords')
    {{ settings()->keywords }}
@endsection

@section('content')
    <main class="container-fluid py-3 overflow-hidden" style="color:#7E57C2;">
        <div class="card">
            <div class="card-header text-white fs-4 d-flex" style="background-color:#7E57C2;">
                <div class="me-auto">Zarządzanie postami</div> 
                <div>
                    <a href="{{ route('admin.posts.create') }}">
                        <button class="btn btn-outline-light">+ Nowy</button>
                    </a>
                </div>
            </div>
            <div class="card-body">
                @foreach($posts as $post)
                    <div class="card mb-4 shadow d-flex">
                        <div class="card-header fs-4" style="color: white;background-color: #7E57C2;">
                            {{ $post->title }}
                        </div>
                        <div class="card-body row d-flex fs-5">
                            <div class="col-lg-10 col-12 d-flex fs-6">
                                {{ strip_tags(Str::of($post->content)->limit(250)) }}
                            </div>
                            <div class="col-lg-2 col-12 mt-lg-0 mt-3 d-grid gap-3">
                                <a class="my-auto" href="{{ route('post', ['title' => Str::slug($post->title, '_')]) }}">
                                    <button class="btn btn-primary w-100 py-2">
                                        Pokaż post
                                    </button>
                                </a>
                                <a class="my-auto" href="{{ route('admin.posts.edit', ['title' => Str::slug($post->title, '_')]) }}">
                                    <button class="btn btn-success w-100 py-2">
                                        Edytuj
                                    </button>
                                </a>
                                <a class="my-auto" href="{{ route('admin.posts.delete', ['id' => $post->id]) }}">
                                    <button class="btn btn-danger w-100 py-2">
                                        Usuń
                                    </button>
                                </a>
                            </div>
                        </div>
                        
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection