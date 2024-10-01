<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BusinessHub ERP | Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="BusinessHub ERP Home" />

    <link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">

    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{ asset('bootstrap.css') }}">
    <!-- Theme style  -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">

</head>
<body>
<div id="page">
    <div id="fh5co-container" class="js-fullheight">
        <div class="countdown-wrap js-fullheight">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="display-t js-fullheight">
                        <div class="display-tc animate-box">
                            <nav class="fh5co-nav" role="navigation">
                                <div id="fh5co-logo">
                                    <img src="{{ asset('images/bh-logo.svg') }}">
                                </div>
                            </nav>
                            <h1>BusinessHub | ERP</h1>
                            <h2>Business Management System Made by <a href="https://businesshub.co.kr/" target="_blank">businesshub.co.kr</a></h2>
                            @if (Route::has('login'))
                                <div class="row">
                                    <div class="col-md-12 desc">
                                        <ul class="fh5co-social-icons">
                                            @auth
                                                <a href="{{ url('/dashboard') }}">Dashboard</a>
                                            @else
                                                <li><a href="{{ url('/login') }}">Login</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-cover js-fullheight" style="background-image:url('{{ asset('images/home-img.png') }}');"></div>
    </div>
</div>

</body>
</html>
