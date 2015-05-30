@extends('_layouts.main')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <h1><a class="" href="{{ env('APP_URL') }}">TORelay.com</a></h1>

            <h5>About</h5>
            <p>
                This site is a simple <a href="https://www.torproject.org/">TOR</a> relay on the web.
            </p>
            <p>
                Submit a website and our server will fetch the website using Tor.
            </p>

            <h5>What is Tor?</h5>
            <p>
                Tor is free software and an open network that helps you defend against traffic analysis,
                a form of network surveillance that threatens personal freedom and privacy, confidential
                business activities and relationships, and state security.
            </p>

            <h5>Is this site anonymous?</h5>
            <p>
                No because you are accessing our server (torelay.com) without using TOR we see your IP.
                However, the website being retrieved will be fetched under TOR so they won't see who you are.
            </p>

            <h5>Is there a quick way to access the website?</h5>
            <p>
                Type this in your browser address bar:
                <pre>http://torelay.com?url=THEURL</pre>
                For command line you can use curl. Example:
                <pre>curl http://torelay.com?url=http://api.ipify.org?format=json</pre>
            </p>

            <h5>Is this site open source?</h5>
            <p>
                Yes, under the <a href="http://opensource.org/licenses/MIT">MIT License</a>.
                The source can be found at <a href="https://github.com/yadakhov/torelay">https://github.com/yadakhov/torelay</a>
            </p>
        </div>
    </div>
</div>

@stop
