<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body style="background-color:#B39DDB; height:100vh;">
    <div class="h-100 d-flex align-items-center">
        
        <form action="{{ route('password.updated') }}" method="post" class="w-50 mx-auto bg-light p-5 rounded-3 shadow ">
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
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <h3>Resetowanie hasła</h1>
            <div class="row mb-3">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" required id="inputEmail">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword1" class="col-sm-2 col-form-label">Nowe hasło</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" required id="inputPassword1">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword2" class="col-sm-2 col-form-label">Powtórz hasło</label>
                <div class="col-sm-10">
                    <input type="password" name="password_confirmation" class="form-control" required id="inputPassword2">
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Resetuj hasło"/>
        </form>
    </div>
    </body>
</html>