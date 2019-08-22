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
                    <div class="d-flex">
                        <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100 h-100" style="max-width: 40px;">
                        <div class="font-weight-bold pt-2 pl-2">
                            <a href="/profile/{{ $post->user->id }}">
                                <span class="text-dark">{{ $post->user->username }}</span>
                            </a>
                            @if(auth()->user()->id !== $post->user->id)
                                <a href="#" class="pl-3">Follow</a>
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
            </div>
        </div>
    </div>
</div>
@endsection