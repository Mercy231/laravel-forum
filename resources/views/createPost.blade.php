@extends('components/layout')

@section('title')
    Create new post
@endsection

@section('content')
    <div class="content">
        <div class="createPost-area">
            <div>
                <form method="post" action="{{ route('user.createPost') }}" class="form-signin w-100 m-auto">
                    @csrf
                    <textarea id="text" name="text" class="form-control" placeholder="Your text here"></textarea>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
