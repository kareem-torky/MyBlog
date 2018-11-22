@extends('layouts.app')

@section('content')
<p class="text-center">
    <a href="/posts" class="btn btn-light">Back to posts</a>
</p>

@include('errors')

<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <form method="POST" action="/posts/{{ $post->id }}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf

            <div class="form-group">
                <label for="post-title">Title</label>
                <input type="text" class="form-control" id="post-title" name="title" value="{{ $post->title }}">
            </div>

            <div class="form-group">
                <label for="post-body">Body</label>
                <textarea class="form-control" id="summary-ckeditor" rows="6" name="body">{{ $post->body }}</textarea>
            </div>

            <p class="text-center">
                <input type="file" name="cover-image" accept="image/*" />
            </p>

            <p class="text-center">
                <button type="submit" class="btn btn-primary">Apply edit</button>
            </p>
        </form>
    </div>
</div>

@endsection