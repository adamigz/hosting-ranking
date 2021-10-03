@extends('layouts.app')

@section('title', settings()->title)

@section('description', settings()->description)

@section('keywords', settings()->keywords)

@section('content')
    <main class="container-fluid py-3 d-flex overflow-hidden" style="color:#7E57C2;">
        <div class="card w-100">
            <div class="card-header text-white fs-4" style="background-color:#7E57C2;">
                Polityka prywatności
            </div>
            <div class="card-body">
                lorem ipsum
            </div>
        </div>
    </main>
@endsection