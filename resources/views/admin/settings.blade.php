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
                <div class="me-auto">Ustawienia</div> 
            </div>
            <div class="card-body">
                <form action="{{ route('admin.saveSettings') }}" class="col-lg-9 col-11 mx-auto bg-light p-lg-5 p-4 rounded-3 shadow " method="post">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    <div class="row mb-3">
                        <label for="inputTitle" class="col-sm-2 col-form-label">Meta title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" value="{{ $settings->title }}" autofocus id="inputTitle">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputDesc" class="col-sm-2 col-form-label">Meta description</label>
                        <div class="col-sm-10">
                            <textarea type="text" name="description" class="form-control" id="inputDesc">{{ $settings->description }}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputKeywords" class="col-sm-2 col-form-label">Meta keywords</label>
                        <div class="col-sm-10">
                            <textarea type="text" name="keywords" class="form-control" id="inputKeywords">{{ $settings->keywords }}</textarea>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Zapisz"/>
                </form>
            </div>
        </div>
    </main>
@endsection