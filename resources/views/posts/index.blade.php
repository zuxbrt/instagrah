@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex flex-row justify-content-center">
        @foreach($profiles as $profile)

        <div class="column ml-3 mr-3">

                <div class="row w-100">
                    <div class="col-6">
                        <a href="/profile/{{ $profile->user_id  }}">

                            @if ($profile->image !== null)
                                <img src="/storage/{{ $profile->image }}" class="rounded-circle"
                                style="width:60px; height: 60px;">
                            @else
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSPoiOPl_l2kX5BZsLACATzipLjD92P6m7t7ZmZzwJ-g_47dIGF"
                                class="rounded-circle"
                                style="width:60px; height: 60px;">
                            @endif
                            
                        </a>
                    </div>
                </div>

                <span class="font-weight-bold w-100">
                    <a href="/profile/{{ $profile->user_id }}">
                        <p class="text-dark pt-1 text-center">{{ $profile->title }}</p>
                    </a>
                </span>
            </div>
            
        @endforeach
    </div>


    @if(auth()->user()->following()->count() < 1)
        <p class="text-center">Your feed is empty.</p>
    @elseif($posts->count() < 1)
        Follow more users to get more posts in your feed.
    @else

        @foreach($posts as $post)

        <div class="row">
            <div class="col-6 offset-3">
                <a href="/p/{{ $post->id }}">
                    <img src="/storage/{{ $post->image }}" class="w-100">
                </a>
            </div>
        </div>

        <div class="row pt-2 pb-4">
            <div class="col-6 offset-3">
                <div>
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

        @endforeach
            
        </div>

        <div class="row">
            <div class="div" style="position: relative; margin-left:auto; margin-right:auto;">{{ $posts->links() }}</div>
        </div>

    @endif
</div>
@endsection