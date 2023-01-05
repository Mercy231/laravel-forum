@extends('components/layout')

@section('title')
    Edit Post
@endsection

@section('content')
    <div class="content">
        <div class="editPost-area">
            <div>
                <form method="post" action="" class="form-signin w-100 m-auto">
                    @csrf
                    <textarea id="text" name="text"
                              class="form-control" placeholder="Your text here">{{ $post['text'] }}</textarea>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="/deletePost/{{$post['id']}}" class="btn btn-danger">Delete</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
