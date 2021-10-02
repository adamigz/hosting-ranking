@extends('layouts.app')

@section('title', settings()->title)

@section('description', settings()->description)

@section('keywords', settings()->keywords)

@section('content')
    <main class="container-fluid py-3 d-flex overflow-hidden" style="color:#7E57C2;">
        <div class="card w-100">
            <div class="card-header text-white fs-4" style="background-color: #7E57C2;">
                Skontaktuj się z nami
            </div>
            <div class="card-body">
                <form action="{{ route('contact.send') }}" method="post" class="col-lg-9 col-11 mx-auto bg-light p-lg-5 p-4 rounded-3 shadow">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" autofocus required id="inputEmail">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputTitle" class="col-sm-2 col-form-label">Tytuł</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" required id="inputTitle">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputTitle" class="col-sm-2 col-form-label">Treść</label>
                        <div class="col-sm-10">
                            <textarea type="text" rows="5" name="content" class="form-control" id="inputTitle"></textarea>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Wyślij"/>
                </form>
            </div>
        </div>
    </main>
@endsection