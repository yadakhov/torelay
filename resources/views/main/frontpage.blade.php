@extends('_layouts.main')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <h1><a class="" href="{{ env('APP_URL') }}">TORelay.com</a></h1>
            <form class="form-horizontal" action="{{ url('/') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" id="url" name="url" placeholder="url" value="{{ \Request::get('url', $url) }}">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">Go</button>
                    </span>
                </div>
            </form>
            <div style="padding-top: 30px;">
                <a href="{{ url('/about') }}">about</a>
            </div>
        </div>
    </div>
</div>

@stop
