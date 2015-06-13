<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Yada Khov">
    <meta name="description" content="A simple TOR Relay.  Accessing TOR over the cloud.  No need to install a TOR server.">
    <meta name="keywords" content="tor, tor relay, ip blocking circumvention, tor online, tor project, censorship circumvention, traffic analysis, communications research">

    <title>torelay - A simple TOR Relay</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/readable/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="apple-touch-icon" href="{{ url('/img/apple-touch-icon.png') }}">
    <link href="{{ url('/css/app.css') }}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

@yield('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="{{ url('/js/app.js') }}"></script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-63556433-1', 'auto');
    ga('send', 'pageview');
</script>
</body>
</html>
