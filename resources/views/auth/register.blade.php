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
        
        <form action="{{ route('register') }}" method="post" class="col-lg-6 col-11 mx-3 mx-lg-auto bg-light p-5 rounded-3 shadow ">
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
            <h3>Rejestracja</h1>
            <div class="row mb-3">
                <label for="inputName" class="col-sm-2 col-form-label">Imię</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" required id="inputName">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" required id="inputEmail">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword1" class="col-sm-2 col-form-label">Hasło</label>
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
            <div class="row mb-3">
                <a class="link" style="color: #7E57C2;" href="{{ route('login') }}">Masz już konto?</a>
            </div>
            <input type="submit" class="btn btn-primary" value="Zarejestruj"/>
        </form>
    </div>
    </body>
</html>