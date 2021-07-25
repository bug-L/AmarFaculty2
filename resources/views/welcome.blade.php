<!DOCTYPE html>
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
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="Find and review teachers from Bangladeshi private universities. Search using teacher's name or initials.">

        <title>AmarFaculty - Review University Teachers in Bangladesh</title>

        <link rel="icon" href="{{ asset('img/icon.png') }}">

        <link type="text/css" rel="stylesheet" href="{{ asset('css/custom.css') }}"  media="screen,projection"/>

        <!-- Fonts -->
        <!--MATERIALIZE: Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <!--MATERIALIZE: Import materialize.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        
        {{-- Animate --}}
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

        <!--Begin custom css-->
        <style>
     

       
        </style>

        <!--End custom css-->
    
    </head>
    <body class="bg">
        
    <div class="container valign-wrapper" style="min-height: 100vh;">
        <div class="row center-align">
            <div class="col s12 l8 push-l2">
                <form action="/professors/search" method="POST" role="search">
                {{ csrf_field() }}
                    <div class="row">
                        <div class="col s10 push-s1 l8 push-l2">
                        <img src="{{ asset('img/amarguru_logo.png') }}" class="responsive-img" alt="amarguru_logo">
                        </div>
                        <br>
                        
                        <div class="input-field col s8 push-s2 m6 push-m3" style="margin-bottom: 12px;">
                            <select name="university_id" id="professor-university" required onchange="showDiv('hidden_div', this)">
                                <option style="color: white" value="" disabled selected>Select university</option>
                               
                                @foreach($universities as $university)
                                <option value="{{ $university->id }}">{{ $university->name }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div id="hidden_div">
                            <div class="input-field col s12 animated fadeInUp" style="margin-bottom: 12px;">
                                <input type="text" class="validate" id="search" name="q" minlength="3" maxlength="30" required onkeyup="EnableDisable(this)">
                                <label for="search" class="black-text text-lighten-2">Teacher name/initials</label>
                            </div>

                            <div class="input-field col s12">
                                <button id="btnSubmit" type="submit"  class="btn red lighten-1 yellow-text text-lighten-2  m-2 waves-effect waves-light animated fadeIn delay-1s" disabled><i class="material-icons left">search</i><b>Look Up</b></button>
                            </div>
                        </div>
                      
                    </div>
                    
                    <div style="min-height: 40px;">
                    
                    @if($errors->any())
                    <p class="red-text">
                        <small>
                        {!! $errors->first() !!}            
                        </small>
                    </p>
                    @endif   
                    </div>
                </form>
            </div>
        </div>
    </div>
       
    <!--Materialize: JavaScript at end of body for optimized loading-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
    });

    function showDiv(divId, element)
    {
        document.getElementById(divId).style.display = element.value != "" ? 'block' : 'none';        
    }

    function EnableDisable(txtPassportNumber) {
        //Reference the Button.
        var btnSubmit = document.getElementById("btnSubmit");
 
        //Verify the TextBox value.
        if (txtPassportNumber.value.length >= 3) {
            //Enable the TextBox when TextBox has value.
            btnSubmit.disabled = false;
        } else {
            //Disable the TextBox when TextBox is empty.
            btnSubmit.disabled = true;
        }
    };

    </script>

    </body>
</html>
