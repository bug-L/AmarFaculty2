<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-149264208-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-149264208-1');
    </script>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title'){{ config('app.name', 'AmarGuru') }}</title>

    <!-- Scripts -->
    <!-- messes up collapsing offensive shit: <script src="{{ asset('js/app.js') }}" defer></script> -->

    <link rel="icon" href="{{ asset('img/icon.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!--MATERIALIZE: Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      
    <!-- Styles -->
    
    <!--MATERIALIZE: Import materialize.css-->
    {{-- local materialize <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"  media="screen,projection"/> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- JQuery -->
    <!-- script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    @yield('links')
    @yield('styles')

    <link type="text/css" rel="stylesheet" href="{{ asset('css/custom.css') }}"  media="screen,projection"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '967974950204596');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=967974950204596&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
</head>
<body >

    <div id="app" >
    
        @include('partials.navbar')

        <div class="container content">
            <main>
                @yield('content')
            </main>
        </div>

    </div>
    

    <footer class="page-footer blue-grey">
    <div class="footer-copyright">
        <div class="container white-text">
        © 2020 AmarGuru
        <a href="http://fb.me/AmarGuruOfficial" target="blank" class="blue-text text-lighten-5 right">              Facebook</a>
        </div>
    </div>
    </footer>

     <!--Materialize: JavaScript at end of body for optimized loading-->
     {{--local <script src="{{ asset('js/materialize.min.js') }}"></script> --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
     
     
     <!--Navbar Sidebar -->
    <script>
     M.AutoInit();
     </script>

@yield('scripts')

</body>
</html>
