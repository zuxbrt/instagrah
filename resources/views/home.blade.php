@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://www.thespruceeats.com/thmb/viMpTnfizB8pKPm9ssdAcLcAUhY=/450x0/filters:no_upscale():max_bytes(150000):strip_icc()/croatian-bean-soup-3-56a2791f5f9b58b7d0cb0e05.jpg">
        </div>
        <div class="col-9 pt-5">
            <div><h1>{{ $user->username }}</h1></div>
            <div class="d-flex">
                <div class="pr-4"><strong>5</strong> tanjira</div>
                <div class="pr-4"><strong>2</strong> pratitelja</div>
                <div class="pr-4"><strong>5</strong> prati</div>
            </div>
        </div>
    </div>

    <div class="row pt-5">
        <div class="col-4">
            <img src="https://www.venturists.net/wp-content/uploads/2016/08/white-bean-soup-1.jpg" class="w-100">
        </div>
        <div class="col-4">
            <img src="https://www.venturists.net/wp-content/uploads/2016/08/white-bean-soup-1.jpg" class="w-100">
        </div>
        <div class="col-4">
            <img src="https://www.venturists.net/wp-content/uploads/2016/08/white-bean-soup-1.jpg" class="w-100">
        </div>
    </div>
</div>
@endsection
