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
    <main class="container-fluid py-3 d-flexoverflow-hidden" style="color:#7E57C2;">
        <div class="row-cols-lg-1 pe-lg-2 d-lg-flex flex-nowrap">
            <div class="col-12 col-lg-8 me-lg-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title mb-3">
                            <h3>Ostanie posty na blogu</h3>
                        </div>
                        @foreach($recentPosts as $post)
                            <div class="card mb-3 shadow">
                                <div class="card-header text-white h5" style="background-color:#7E57C2;">
                                    {{ $post->title }}
                                </div>
                                <div class="card-body">
                                    <p class="card-text" style="color:#320d3e;">{{ strip_tags(Str::of($post->content)->limit(250)) }}</p>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('post', ['title' => Str::slug($post->title, '_')]) }}" class="btn btn-outline-warning" style="color:#320d3e;">Czytaj dalej</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div> 
            </div>
            <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title mb-3">
                            <h3>Ranking hostingów</h3>
                        </div>
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
                                            <a href="{{ route('vote', $hosting->id) }}">
                                                @if(Auth::user()->votedOn($hosting->id))
                                                <button class="btn btn-success">
                                                    {{ $hosting->votes_count }}
                                                </button>
                                                @else
                                                <button class="btn btn-warning">
                                                    {{ $hosting->votes_count }}
                                                </button>
                                                @endif
                                            </a>        
                                            @endauth
                                            @guest
                                            <a href="{{ route('login') }}">
                                                <button class="btn btn-warning">
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
                    </div>
                </div> 
            </div>
        </div>
        
    </main>
@endsection
