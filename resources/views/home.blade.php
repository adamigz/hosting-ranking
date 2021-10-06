@extends('layouts.app')

@section('title', settings()->title)

@section('description', settings()->description)

@section('keywords', settings()->keywords)

@section('content')
    <main class="container-fluid py-3 d-flexoverflow-hidden" style="color:#7E57C2;">
        <div class="row-cols-lg-1 pe-lg-2 d-lg-flex flex-nowrap">
            <div class="col-12 col-lg-8 me-lg-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title mb-3">
                            <h3>Ostanie posty na blogu</h3>
                        </div>
                        @if(count($recentPosts) > 0)
                        @foreach($recentPosts as $post)
                            <div class="card mb-3 shadow">
                                <div class="card-header text-white h5" style="background-color:#7E57C2;">
                                    {{ $post->title }}
                                </div>
                                <div class="card-body">
                                    <p class="card-text" style="color:#320d3e;">{{ strip_tags(Str::of($post->content)->limit(250)) }}</p>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('post', ['title' => $post->slug]) }}" class="btn btn-outline-warning" style="color:#320d3e;">Czytaj dalej</a>
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
            </div>
            <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title mb-3">
                            <h3>Ranking hostingów</h3>
                        </div>
                        @if(count($hostings) > 0)
                            @foreach($hostings as $index => $hosting) 
                                <div class="card shadow mb-3">
                                    <div class="card-body row py-2">
                                        <div class="col-3 d-flex">
                                            @if($index == 0)
                                                <p class="h1 m-auto" style="color:#fbc02d;">
                                                    {{ $index+1 }}.
                                                </p>
                                            @elseif($index == 1)
                                                <p class="h2 m-auto" style="color:#757575;">
                                                    {{ $index+1 }}.
                                                </p>
                                            @elseif($index == 2)
                                                <p class="h2 m-auto" style="color:#6d4c41;">
                                                    {{ $index+1 }}.
                                                </p>
                                            @else
                                                <p class="h3 m-auto">
                                                    {{ $index+1 }}.
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-4 my-auto d-flex">
                                            <div class="d-grid">
                                                <div class="fs-5 mb-2">
                                                    Głosy
                                                </div>
                                                <div>
                                                    @auth
                                                        @if(Auth::user()->votedOn($hosting->id))
                                                            <a href="{{ route('vote', ['id' => $hosting->id]) }}">
                                                                <button class="btn btn-success d-flex">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                                                    </svg>
                                                                </button>
                                                            </a>
                                                        @else
                                                            <a href="{{ route('vote', ['id' => $hosting->id]) }}">
                                                                <button class="btn btn-warning d-flex">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                                    </svg>
                                                                </button>
                                                            </a>
                                                        @endif
                                                    @endauth
                                                    @guest
                                                        <a href="{{ route('login') }}">
                                                            <button class="btn btn-warning d-flex">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                                </svg>
                                                            </button>
                                                        </a>
                                                    @endguest
                                                </div>
                                            </div>
                                            <p class="my-auto ms-3 fs-2">
                                                {{ $hosting->votes_count }}
                                            </p>
                                        </div>
                                        <div class="col d-grid">
                                            <div class="row mx-auto">
                                                <p class="fs-4">{{ $hosting->name }}</p>
                                            </div>
                                            <div class="row mx-auto">
                                                <a href="{{ route('hosting', ['id' => $hosting->id]) }}">
                                                    <button class="btn btn-primary">
                                                        Więcej
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert text-white d-flex justify-content-center col-12 col-lg-8 mx-auto" style="background-color: #7E57C2;">
                                Nie ma hostingów do wyświetlenia
                            </div>
                        @endif
                    </div>
                </div> 
            </div>
        </div>
        
    </main>
@endsection
