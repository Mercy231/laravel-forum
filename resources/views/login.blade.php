@extends('components/layout')

@section('title')
    Log in
@endsection

@section('style')
    <style>
        html, body{
            height: 100%;
            width: 100%;
            background-color: lightgray;
        }
        .content {
            width: 100%;
            height: 80%;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        form {
            min-width: 350px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
        }
        input {
            margin: 10px 0;
        }
        button {
            max-width: 100px;
        }
        .errors {
            padding: 20px 0;
            height: 30px;
        }
    </style>
@endsection

@section('content')
    <main>
        <form method="post" action="{{ route('user.login') }}" class="form-signin w-100 m-auto">
            @csrf
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
            </svg>
            <h1 class="h3 mb-3 fw-normal">Log in</h1>

            <div class="form-floating">
                <input id="username" name="username" class="form-control" value="{{old('username')}}" placeholder="Username">
                <label for="username">Username</label>
            </div>
            <div class="form-floating">
                <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                <label for="password">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Log in</button>

            <div class="errors">
                @if($errors->any())
                    {{ $errors->first() }}
                @endif
            </div>
        </form>
    </main>
@endsection
