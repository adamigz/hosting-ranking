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
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Głosy</th>
                                    <th scope="col">Nazwa</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hostings as $index => $hosting) 
                                    <tr onMouseOver="this.style.backgroundColor='#EDE7F6'"
    onMouseOut="this.style.backgroundColor='#fff'">
                                        <th scope="row">{{ $index+1 }}</th>
                                        <td>
                                            @auth
                                            <a class="text-decoration-none" href="{{ route('vote', $hosting->id) }}">
                                                @if(Auth::user()->votedOn($hosting->id))
                                                <button class="btn d-flex btn-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-square-fill my-auto me-2" viewBox="0 0 16 16">
                                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
                                                    </svg>
                                                    {{ $hosting->votes_count }}
                                                </button>
                                                @else
                                                <button class="btn d-flex btn-warning">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-square my-auto me-2" viewBox="0 0 16 16">
                                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                    </svg>
                                                    {{ $hosting->votes_count }}
                                                </button>
                                                @endif
                                            </a>        
                                            @endauth
                                            @guest
                                            <a href="{{ route('login') }}">
                                                <button class="btn d-flex btn-warning">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-square my-auto me-2" viewBox="0 0 16 16">
                                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                    </svg>
                                                    <abbr title="Musisz się zalogować, aby móc głosować" class="initialism">{{ $hosting->votes_count }}</abbr>
                                                </button>
                                            </a>
                                            @endguest
                                        </td>
                                        <td>{{ $hosting->name }}</td>
                                        <td>
                                            <a href="{{ route('hosting', ['id' => $hosting->id]) }}">
                                                <button class="btn btn-primary">Więcej</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
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
