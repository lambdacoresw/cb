<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>crea blog</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('front/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <script src="{{ asset('front/js/modernizr.js') }}"></script>
    <script defer src="{{ asset('front/js/fontawesome/all.min.js') }}"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="{{ asset('front/site.webmanifest') }}">
</head>

<body id="top">
    <div id="preloader">
        <div id="loader"></div>
    </div>

    <header class="s-header s-header--opaque">
        <div class="row s-header__navigation">
            <nav class="s-header__nav-wrap">
                <h3 class="s-header__nav-heading h6">Navigate to</h3>
                <ul class="s-header__nav">
                    <li><a href="{{ route('home') }}" title="">Home</a></li>
                    <li class="has-children current">
                        <a href="#0" title="">Categories</a>
                        <ul class="sub-menu">
                            @foreach ($categories as $cat)
                                <li><a href="{{ route('categories.view', $cat->id) }}">{{ $cat->title }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @guest
                        <li>
                            <a href="{{ route('login') }}" title="">Sign In</a>
                        </li>
                    @endguest
                </ul>
                <a href="#0" title="Close Menu" class="s-header__overlay-close close-mobile-menu">Close</a>
            </nav>
        </div>
        <a class="s-header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>
    </header>
    @yield('content')
    <script src="{{ asset('front/js/jquery-3.5.0.min.js') }}"></script>
    <script src="{{ asset('front/js/plugins.js') }}"></script>
    <script src="{{ asset('front/js/main.js') }}"></script>
</body>
</html>
