@extends('layouts.app')

@section('title', settings()->title)

@section('description', settings()->description)

@section('keywords', settings()->keywords)

@section('content')
    <main class="container-fluid py-3 d-flex overflow-hidden" style="color:#7E57C2;">
        <div class="card w-100">
            <div class="card-body">
                <div class="card-title mb-3" style="color:#7E57C2;">
                    <h3>Polityka prywatności</h3>
                </div>
            </div>
        </div>
    </main>
@endsection