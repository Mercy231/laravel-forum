@extends('components/layout')

@section('title')
    Home
@endsection

@section('content')
    <div class="content">
        <div class="createPost-area">
            <form id="create-post-form" class="form-signin w-100 m-auto" method="post">
                @csrf
                <div id="create-postClose" class="text-end">
                    <span class="create-postClose">&times;</span>
                </div>
                <textarea id="create-postText" name="text" class="form-control" placeholder="Your text here" required></textarea>
                <div class="text-end">
                    <button id="create-post-button" type="submit" class="btn btn-success">Create</button>
                </div>
            </form>
        </div>

        <div class="editPost-area">
            <form id="edit-post-form" class="form-signin w-100 m-auto" method="post">
                @csrf
                <div id="edit-postClose" class="text-end">
                    <span class="edit-postClose">&times;</span>
                </div>
                <textarea id="edit-postText" name="text" class="form-control" placeholder="Your text here" required></textarea>
                <div class="text-end">
                    <button id="editPostDelete" type="button" class="btn btn-danger">Delete</button>
                    <button id="editPostSave" type="button" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>

        @if(Auth::check())
            <div class="text-end create-postButton">
                <a id="create-postButton" class="btn btn-success">New post</a>
            </div>
        @endif
        <div id="posts-area" class="posts-area">

            @if(!empty($posts))
                    @foreach($posts as $post)
                        <div id="{{ $post->id }}" class="post">
                            <div class="username">
                                <h4>{{ $post->username }}</h4>
                            </div>
                            <div class="post-text">
                                <p>{{ $post->text }}</p>
                            </div>
                            @if(Auth::check() && Auth::user()->id == $post->user_id)
                                <div class="text-end">
                                    <button type="submit" class="btn btn-warning">Edit</button>
                                </div>
                            @endif
                        </div>
                    @endforeach
            @endif
        </div>
    </div>
    <script src="{{ asset('/public/js/home.js') }}"></script>
@endsection
