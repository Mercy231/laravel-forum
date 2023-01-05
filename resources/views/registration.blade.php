@extends('components/layout')

@section('title')
    Register
@endsection

@section('content')
    <div class="content-login-reg">
        <main>
            <form method="post" action="{{ route('user.registration') }}" class="form-signin w-100 m-auto">
                @csrf
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                </svg>
                <h1 class="h3 mb-3 fw-normal">Create new account</h1>

                <div class="form-floating">
                    <input id="username" name="username" type="text" class="form-control" value="{{old('username')}}" placeholder="Username">
                    <label for="username">Username</label>
                </div>
                <div class="form-floating">
                    <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                    <label for="password">Password</label>
                </div>
                <div class="form-floating">
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Confirm password">
                    <label for="password_confirmation">Confirm password</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Create</button>

                <div class="errors">
                    @if($errors->any())
                        {{ $errors->first() }}
                    @endif
                </div>
            </form>
        </main>
    </div>
@endsection
