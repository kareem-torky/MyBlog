@extends('layouts.app')

@section('content')
<div class="text-center">
    <p class="text-center">
        <a href="/posts" class="btn btn-light">Back to posts</a>
    </p>

    <h2>{{ $post->title }}</h2>
    <br>

    <img src="/storage/cover_images/{{ $post->cover_image }}" width="500px" class="post-image">

    <p>{!! $post->body !!}</p>
    <p><small>Created at: {{  $post->created_at }}</small></p>

    @auth
        @if(Auth::user()->id == 1)
            <div class="container">
                <div class="row">
                    <div class="col-lg-5"></div>
                    <div class="col-lg-1">
                        {{-- Edit Button --}}
                        <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit post</a>
                    </div>
                    <div class="col-lg-1">
                        {{-- Delete  button --}}
                        <form method="POST" action="/posts/{{ $post->id }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    <div class="col-lg-5"></div>
                </div>
            </div>
        @endif
    @endauth

</div>

{{-- Add a comment --}}
@include('errors')

@auth
    <div class="text-center">
        <form method="POST" action="/posts/{{ $post->id }}/comments">
            @csrf
            <textarea class="form-control comment-textarea" rows="2" name="comment"></textarea>
            <p class="text-center">
                <button type="submit" class="btn btn-primary add-comment-btn">Add comment</button>
            </p>
        </form>
    </div>
@endauth

{{-- Show comments --}}
@foreach ($post->comments as $comment)
    <div class="card">
        <div class="container">
            <div class="row">
                <div class="col-lg-11">
                    <p> {{ $comment->comment }} </p>
                    <p><small> By: {{ $comment->user->name }} </small></p>
                </div>

                {{-- both comment writer and admin can delete a comment --}}   
                <div class="col-lg-1">
                    @auth
                        @if(Auth::user()->id == $comment->user->id || Auth::user()->id == 1)
                            <form method="POST" action="/posts/{{ $post->id }}/comments/{{ $comment->id }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-primary x-button">X</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
    <br>
@endforeach

@guest
    <div class="container">
        <div class="row">
            <div class="col-lg-6 text-center">
                <p>To add a comment:</p>
                <a href="/register" class="btn btn-primary no-margin-btn">Sign up</a>
            </div>

            <div class="col-lg-6 text-center">
                <p>Already have an account ?</p>
                <a href="/login" class="btn btn-primary no-margin-btn">Log in</a> 
            </div>
        </div>
    </div>
      
@endguest

@endsection