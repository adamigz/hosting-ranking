@extends('layouts/app')

@section('title', settings()->title)

@section('description', settings()->description)

@section('keywords', settings()->keywords)

@section('content')
    <main class="container-fluid d-flex align-items-center py-3 overflow-hidden">
        <form action="{{ route('admin.editPost', ['title' => $post->slug]) }}" class="col-lg-9 col-11 mx-auto bg-light p-lg-5 p-4 rounded-3 shadow " method="post" enctype="multipart/form-data">
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
            <h3>Edycja posta</h3>
            <div class="row mb-3">
                <label for="inputTitle" class="col-sm-2 col-form-label">Tytuł</label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" value="{{ $post->title }}" autofocus required id="inputTitle">
                </div>
            </div>
            <div class="mb-3">
                <label for="inputTitle" class="col-sm-2 col-form-label">Treść</label>
                <div class="form-group">
                    <textarea class="ckeditor form-control" name="content">{{ $post->content }}</textarea>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <label for="inputDescription" class="col-sm-2 col-form-label">Meta description</label>
                <div class="col-sm-10">
                    <textarea name="description" type="text" class="form-control" id="inputDescription">{{ $post->description ?? '' }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputKeywords" class="col-sm-2 col-form-label">Meta keywords</label>
                <div class="col-sm-10">
                    <textarea name="keywords" type="text" class="form-control" id="inputKeywords">{{ $post->keywords ?? '' }}</textarea>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Dodaj"/>
        </form>
    </main>
    
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection