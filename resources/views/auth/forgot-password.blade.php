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
        
        <form action="{{ route('password.email') }}" method="post" class="w-50 mx-auto bg-light p-5 rounded-3 shadow ">
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
            <h3>Odzyskiwanie hasła</h1>
            <div class="card">
                <div class="card-body" style="color: #7E57C2;">
                    Zapomniałeś/aś hasła? To żaden problem
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" required id="inputEmail3">
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Wyślij email"/>
        </form>
    </div>
    </body>
</html>