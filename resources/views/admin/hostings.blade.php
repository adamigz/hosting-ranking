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
                <div class="me-auto">Zarządzanie hostingami</div> 
                <div>
                    <a href="{{ route('admin.hostings.create') }}">
                        <button class="btn btn-outline-light">+ Nowy</button>
                    </a>
                </div>
            </div>
            <div class="card-body">
                @foreach($hostings as $hosting)
                    <div class="card mb-4 shadow d-grid">
                        <div class="card-body row d-flex fs-5">
                            <div class="col d-flex align-items-center justify-content-center">
                                <button class="btn btn-warning btn-lg">
                                    {{ $hosting->votes_count }}
                                </button>
                            </div>
                            <div class="col-9 col-lg-2 d-flex align-items-center">{{ $hosting->name }}</div>
                            <div class="col-12 my-2 col-lg-5 d-flex align-items-center fs-6">{{ Str::of($hosting->description)->limit(150) }}</div>
                            <div class="col-12 my-2 col-lg-2 d-flex align-items-center">
                                <!--<button class="btn btn-primary btn-lg">
                                    Pokaż logo
                                </button>-->
                                <img src="{{ asset('storage/'.$hosting->logo_path) }}" alt="Brak loga" class="img-thumbnail mx-lg-0 mx-auto">
                            </div>
                            <div class="col-12 col-lg-2 d-grid gap-2">
                                <a class="my-auto" href="{{ route('hosting', ['id' => $hosting->id]) }}">
                                    <button class="btn btn-primary w-100 py-2">
                                        Pokaż stronę
                                    </button>
                                </a>
                                <a class="my-auto" href="{{ route('admin.hostings.edit', ['id' => $hosting->id]) }}">
                                    <button class="btn btn-success w-100 py-2">
                                        Edytuj
                                    </button>
                                </a>
                                <a class="my-auto" href="{{ route('admin.hostings.delete', ['id' => $hosting->id]) }}">
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