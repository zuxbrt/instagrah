@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://www.thespruceeats.com/thmb/viMpTnfizB8pKPm9ssdAcLcAUhY=/450x0/filters:no_upscale():max_bytes(150000):strip_icc()/croatian-bean-soup-3-56a2791f5f9b58b7d0cb0e05.jpg">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $user->username }}</h1>
                <a href="#">Add New Post</a>
            </div>
            <div class="d-flex">
                <div class="pr-4"><strong>5</strong> tanjira</div>
                <div class="pr-4"><strong>2</strong> pratitelja</div>
                <div class="pr-4"><strong>5</strong> prati</div>
            </div>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url }}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        <div class="col-4">
            <img src="https://www.venturists.net/wp-content/uploads/2016/08/white-bean-soup-1.jpg" class="w-100">
        </div>
        <div class="col-4">
            <img src="https://coolinarika.azureedge.net/images/_variations/8/f/8f33087bf0f882c91a7b6635fe51c165_view_l.jpg?v=13" class="w-100">
        </div>
        <div class="col-4">
            <img src="https://coolinarika.azureedge.net/images/_variations/b/4/b40b37e7c6b77b292847629d67340462_view_l.jpg?v=2" class="w-100">
        </div>
    </div>
</div>
@endsection
