@extends('layouts.app')

@section('title')
    {{ $hosting->name.' - '.settings()->title }}
@endsection

@section('description')
    {{ $hosting->desc == '' ? settings()->description : $hosting->desc }}
@endsection

@section('keywords')
    {{ $hosting->keywords == '' ? settings()->keywords : $hosting->keywords }}
@endsection

@section('content')
    <main class="container-fluid py-3 d-flex overflow-hidden">
        <div class="card col-12 col-lg-10 mx-auto">
            <div class="card-header" style="background-color:#7E57C2;">
                <h4 class="text-white">
                    {{ $hosting->name }}
                </h4>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <img class="img img-thumbnail float-start me-3 rounded w-25" src="{{ asset('storage/'.$hosting->logo_path) }}" alt="Brak zdjęcia">
                    <div class="h5 mb-3" style="color:#512DA8;">
                        {{ $hosting->description }}
                    </div>
                </div>
            </div>
            <div class="card-body d-flex px-4">
                <h4>Komentarze</h4>
                @auth
                <div class="ms-auto">
                    <button id="addCommentButton" class="btn btn-warning">Dodaj komentarz</button>
                </div>
                @endauth
                @guest
                <div class="ms-auto">
                    <a href="{{ route('login') }}">
                        <button class="btn btn-warning">Zaloguj się, aby dodać komentarz</button>
                    </a>
                </div>
                @endguest
            </div>
            <div class="px-4" id="addCommentForm" style="visibility: hidden; height: 0px;">
                <form class="w-75 mx-auto d-flex" action="{{ route('addComment', ['id' => $hosting->id]) }}" method="post">
                    @csrf
                    <textarea class="form-control me-3" placeholder="Treść komentarza" name="content" rows="3" required></textarea>
                    <input type="submit" class="btn btn-outline-warning" value="Dodaj komentarz">
                </form>
            </div>
            <div class="card-body d-grid gap-3">
                @if(count($hosting->comments) != 0)
                    @foreach($hosting->comments as $comment)
                    <div class="card shadow">
                        <div class="card-header" style="background-color: #7E57C2;">
                            <h5 class="text-white my-auto">{{ $comment->user->name }}</h5>
                        </div>
                        <div class="card-body" style="color: #512DA8;">
                            <div class="row ps-4">
                                {{ $comment->content }}
                            </div>
                            <div class="d-flex justify-content-end">
                                @if($comment->updated_at != $comment->created_at)
                                    Zaktualizowano: {{ $comment->updated_at }}
                                @else
                                    Dodano: {{ $comment->created_at }}
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="card w-75 mx-auto shadow" style="background-color: #7E57C2;">
                        <div class="card-body d-flex justify-content-center fs-4" style="color: white;">
                            Brak komentarzy
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
    <script>
        const addCommentButton = document.getElementById('addCommentButton');
        const addCommentForm = document.getElementById('addCommentForm');
        
        addCommentButton.addEventListener('click', (e) => {
            e.preventDefault();
            
            addCommentForm.style.visibility = 'visible';
            addCommentForm.style.height = 'auto';
            addCommentButton.style.visibility = 'hidden';
        })
    </script>
@endsection