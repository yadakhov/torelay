@extends('_layouts.main')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h1><a class="" href="{{ env('APP_URL') }}">TORelay.com</a></h1>
            <form class="form-horizontal" action="{{ url('/') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" id="url" name="url" placeholder="url" value="{{ \Request::get('url', $url) }}">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">Go</button>
                    </span>
                </div>
            </form>
            <div class="about-panel">
                <a href="{{ url('/about') }}">about</a>
                <a href="{{ url('/about') }}"><img alt="Torelay will fetch your website using TOR." class="img-responsive" src="{{ url('/img/torelay.png') }}"></a>
            </div>

        </div>
    </div>
</div>

@stop
