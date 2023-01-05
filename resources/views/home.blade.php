@extends('components/layout')

@section('title')
    Home
@endsection

@section('content')
    <div class="content">
        <div class="posts-area">
            @if(Auth::check())
                <div class="text-end">
                    <a href="/createPost" class="btn btn-success">New post</a>
                </div>
            @endif
            @if(!empty($posts))
                    @foreach($posts as $post)
                        <div class="post">
                            <div class="username">
                                <h4>{{ $post['username'] }}</h4>
                            </div>
                            <div>
                                <p>{{ $post['text']}}</p>
                            </div>
                            @if(Auth::check() && Auth::user()->id == $post['user_id'])
                                <div class="text-end">
                                    <a href="/editPost/{{ $post['id'] }}" class="btn btn-warning">Edit</a>
                                </div>
                            @endif
                        </div>
                    @endforeach
            @endif
        </div>
    </div>
@endsection
