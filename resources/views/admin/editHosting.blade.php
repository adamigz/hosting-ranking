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
    <main class="container-fluid d-flex align-items-center py-3 overflow-hidden">
        <form action="{{ route('admin.editHosting', ['id' => $hosting->id]) }}" class="col-lg-9 col-11 mx-auto bg-light p-lg-5 p-4 rounded-3 shadow " method="post" enctype="multipart/form-data">
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
            <h3>Edycja hostingu</h3>
            <div class="row mb-3">
                <label for="inputEmail" class="col-sm-2 col-form-label">Nazwa</label>
                <div class="col-sm-10">
                    <input type="text" value="{{ $hosting->name }}" name="name" class="form-control" autofocus required id="inputEmail">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Opis</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="inputPassword" name="description" rows="5">{{ $hosting->description }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="formFile" class="col-sm-2 col-form-label"><abbr title="Jeśli nie chcesz zmienić zdjęcia nie dodawaj żadnego">Zmień logo hostingu</abbr></label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" name="logo" id="formFile">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputUrl" class="col-sm-2 col-form-label">URL</label>
                <div class="col-sm-10">
                    <input type="text" name="url" value="{{ $hosting->url }}" class="form-control" required id="inputUrl">
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <label for="inputDescription" class="col-sm-2 col-form-label">Meta description</label>
                <div class="col-sm-10">
                    <textarea name="desc" class="form-control" id="inputDescription">{{ $hosting->desc }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputKeywords" class="col-sm-2 col-form-label">Meta keywords</label>
                <div class="col-sm-10">
                    <textarea name="keywords" class="form-control" id="inputKeywords">{{ $hosting->keywords }}</textarea>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Edytuj"/>
        </form>
    </main>
@endsection