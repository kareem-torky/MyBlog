@extends('layouts.app')

@section('content')

@auth
    @if(Auth::user()->id == 1)
        <p class="text-center">
            <a href="/posts/create" class="btn btn-light">Create post</a>
        </p>
    @endif
@endauth


<div class="row">
    @foreach ($posts as $post)
        <div class="col-lg-10 offset-lg-1 post-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">
                            <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                        </h4>
                        <p class="card-text text-center">
                            <small>Created at: {{ $post->created_at }}</small>
                        </p>
                    </div>
                </div>             
        </div>
    @endforeach
</div>

<br><br>

@endsection