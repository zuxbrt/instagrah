@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </div>
        <div class="col-4">
            <div>
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row">
                        <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100 h-100" style="max-width: 40px;">
                        <div class="font-weight-bold pt-2 pl-2">
                            <a href="/profile/{{ $post->user->id }}">
                                <span class="text-dark">{{ $post->user->username }}</span>
                            </a>
                            
                            @if(auth()->user()->id !== $post->user->id)
                                <follow-button user-id="{{ $post->user->id }}" follows="{{ $follows }}"></follow-button>
                            @endif

                        </div>
                    </div>
                    <div>
                        @if(auth()->user()->id == $post->user->id)
                        <form method="POST" action="/p/{{ $post->id }}">
    
                            @method('DELETE')
                            @csrf

                            <button type="submit" class="btn btn-danger ml-5">Delete post</button>

                        </form>
                        @endif
                    </div>
                </div>

                <hr>

                <p>
                    <span class="font-weight-bold">
                        <a href="/profile/{{ $post->user->id }}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                    </span> {{ $post->caption }}
                </p>

                    @if($post->comments)
                        @foreach($post->comments as $comment)
                        
                        <div class="d-flex flex-row m-1">
                            <a href="/profile/{{ $comment->user_id }}">
                                <img src="{{ $comment->userImage($comment->user_id) }}" class="rounded-circle w-100 h-100" style="max-width: 40px;">
                            </a>
                            <div class="d-flex pt-2 pl-2 w-100">
                                <span class="text-dark font-weight-bold ">{{ $comment->comment }}</span>
                                <span class="text-dark-small" style="margin-left: auto;">{{ $comment->formatDate($comment->created_at)}}</span>
                            </div>
                        </div>

                        @endforeach
                    @endif


                    <form action="{{ route('comment.post', [ 'post' => $post ]) }}" enctype="multipart/form-data" method="post">
                        @csrf

                        <div class="d-flex flex-row ml-1">

                            <img src="{{ auth()->user()->profile->profileImage() }}" class="rounded-circle w-100 h-100" style="max-width: 40px;">

                            <input id="comment" 
                                type="text" 
                                class="form-control @error('comment') is-invalid @enderror ml-2" 
                                name="comment" 
                                value=""
                                autofocus>

                            <div class="row">
                                <button type="submit" class="btn btn-primary ml-2">comment</button>
                            </div>

                        </div>

                    </form>

                    
            </div>
        </div>
    </div>
</div>
@endsection