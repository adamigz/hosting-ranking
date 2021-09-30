@extends('layouts.app')

@section('title', settings()->title)

@section('description', settings()->description)

@section('keywords', settings()->keywords)

@section('content')
    <main class="container-fluid py-3 d-flex overflow-hidden" style="color:#7E57C2;">
        <div class="card w-100">
            <div class="card-body">
                <div class="card-title mb-3" style="color:#7E57C2;">
                    <h3>Wszystkie posty</h3>
                </div>
                @if(count($posts) > 0)
                @foreach($posts as $post)
                    <div class="card mb-4 shadow d-grid">
                        <div class="card-header h5" style="color: white;background-color: #7E57C2;">
                            {{ $post->title }}
                        </div>
                        <div class="card-body d-flex fs-5">
                            <div class="col-9 col-lg-10 d-flex fs-6">
                                {{ strip_tags(Str::of($post->content)->limit(250)) }}
                            </div>
                            <div class="col-3 col-lg-2 d-flex align-items-center">
                                <a class="m-auto" href="{{ route('post', ['title' => $post->slug]) }}">
                                    <button class="btn btn-outline-warning w-100 py-2">
                                        Pokaż post
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                    <div class="alert text-white d-flex justify-content-center col-12 col-lg-8 mx-auto" style="background-color: #7E57C2;">
                        Nie ma postów do wyświetlenia
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection