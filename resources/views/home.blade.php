@extends('layouts.app')

@section('content')

{{-- Status container --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card status-card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Activity container --}}
<div class="container activity-container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4 class="text-center"><strong>Your Activity</strong></h4>
                <br>

                @if(Auth::user()->id != 1)
                    @if(count($comments)>0)
                        @foreach ($comments as $comment)
                            <div class="card activity-card">     
                                <div class="card-body">
                                    <p>You commented on post <strong>{{ $comment->post->title }}</strong> at {{ $comment->created_at }}</p> 
                                    <p><em>"{{ $comment->comment }}"</em></p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center">You have no activity yet </p>
                    @endif
                @endif

                @if(Auth::user()->id == 1)
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="text-center">Posts</h5>
                            @if(count($posts)>0)
                                @foreach ($posts as $post)
                                    <div class="card activity-card">     
                                        <div class="card-body">
                                            <p>You wrote a post <strong>{{ $post->title }}</strong> at {{ $post->created_at }}</p> 
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-center">You have no posts yet</p>
                            @endif
                        </div>

                        <div class="col-lg-6">
                            <h5 class="text-center">Comments</h5>
                            @if(count($comments)>0)
                                @foreach ($comments as $comment)
                                    <div class="card activity-card">     
                                        <div class="card-body">
                                            <p>You commented on post <strong>{{ $comment->post->title }}</strong> at {{ $comment->created_at }}</p> 
                                            <p><em>"{{ $comment->comment }}"</em></p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                            <p class="text-center">You have no comments yet</p>
                            @endif
                        </div>
                    </div>
                </div>

            @endif
            </div>
        </div>
    </div>

@endsection
