@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-3 pt-4 pb-5 pl-5 pr-5">
            <img src="{{ $user->profile->profileImage() }}"
            class="rounded-circle"
            style="width:100%; height: auto;">
        </div>
        <div class="col-md-8 col-9 pt-4">
            <div class="d-flex justify-content-between align-items-baseline">
            
            <div class="d-flex align-items-center pt-4">
                <div class="flex-row">
                    <div class="h4">{{ $user->username }}</div>
                    <div class="font-weight-bold pt-2">{{ $user->name }}</div>
                </div>
                @if($user->id !== auth()->user()->id)
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                @endif
                
            </div>

            @can('update', $user->profile)
                <a href="/p/create">Add New Post</a>
            @endcan

            </div>
            
            <div class="d-flex pt-4">

                <div class="pr-4">
                    @if ($postsCount === 1)
                        <strong>{{ $postsCount }} </strong>Post
                    @elseif ($postsCount > 1)
                        <strong>{{ $postsCount }} </strong>Posts
                    @else
                        <strong>0</strong> Posts
                    @endif
                </div>

                <div class="pr-4">
                    @if ($followersCount === 1)
                        <strong>{{ $followersCount }} </strong>Follower
                    @elseif ($followersCount > 1)
                        <strong>{{ $followersCount }} </strong>Followers
                    @else
                        <strong>0 </strong>Followers
                    @endif
                </div>

                <div class="pr-4">
                    <strong>{{ $followingCount }}</strong> Following
                </div>

            </div>

            <div>{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url }}</a></div>

            @can('update', $user->profile)
            <div class="pt-4">
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            </div>
            @endcan
            
        </div>
    </div>

    <div class="row pt-5">
        @foreach($user->posts as $post)
        <div class="col-4 pb-4">
            <a href="/p/{{ $post->id }}">
                <img src="{{ Storage::url($post->image) }}" class="w-100">
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
