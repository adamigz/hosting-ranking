@extends('layouts.app')

@section('title')
    {{ $post->title.' - '.settings()->title }}
@endsection

@section('description')
    {{ $post->description == '' ? settings()->description : $post->description }}
@endsection

@section('keywords')
    {{ $post->keywords == '' ? settings()->keywords : $post->keywords }}
@endsection

@section('content')
    <main class="container-fluid py-3 d-flex overflow-hidden" style="color:#7E57C2;">
        <div class="card w-100">
            <div class="card-header text-white fs-4" style="background-color: #7E57C2;">
                {{ $post->title }}
            </div>
            <div class="card-body">
                {!! $post->content !!}
            </div>
            <div class="card-body d-flex justify-content-end">
                {{ $post->updated_at }}
            </div>
        </div>
    </main>
@endsection