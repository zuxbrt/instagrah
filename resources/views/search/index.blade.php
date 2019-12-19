@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row pt-5">
        @foreach($posts as $post)
            <div class="col-4 pb-4">
                <a href="/p/{{ $post->id }}">
                    <img src="{{ Storage::url($post->image) }}" class="w-100">
                </a>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="div" style="position: relative; margin-left:auto; margin-right:auto; margin-bottom: 0;">{{ $posts->links() }}</div>
    </div>
</div>

@endsection