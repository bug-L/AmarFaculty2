<div class="center-align">
    <h1 class="header" style="font-size: 150%; margin-bottom: 0px;">{{ $professor->name }} </h1>
{{-- 
    @if(!empty($professor->initials))
        ({{ strtoupper($professor->initials) }})
    @endif
--}}
    <p>{{ $professor->department->name }}, {{ $professor->university->name }}</p>
</div>

<div style="height: 560px;" class="card large horizontal grey lighten-5">
    <div class="card-image">
        <img class="activator" src="{{ asset('img/envelope.png') }}" alt="Open Report">
    </div>
    
    <div class="row">
        <div class="col s12">

            
            <div class="card-content hide-on-med-and-up">
                <h6 class="red-text text-darken-2"><strong>Report</strong></h6>
                <div style="text-align: center; vertical-align: middle;">
                    <span class="card-title red-text text-darken-2" style="margin-top: 90px;">Open<br><br>
                    <button class="btn-floating btn  red lighten-1 pulse activator"><i class="material-icons yellow-text text-lighten-1">drafts</i></a></span>
                </div>
            </div>
            <div class="card-content hide-on-small-only">
                <h3 class="red-text text-darken-2"><strong>Report</strong></h3>
                <div style="text-align: center; vertical-align: middle;">
                    <span class="card-title red-text text-darken-2" style="margin-top: 90px;"><h4>Open</h4><br>
                    <button class="btn-large btn-floating btn red lighten-1 pulse activator"><i class="large material-icons yellow-text text-lighten-1">drafts</i></a></span>
                </div>
            </div>
            
        </div>
    </div>
    <div class="card-reveal">
        
        <span class="card-title grey-text text-darken-2"><h4>Report<i class="material-icons right">close</i></h4></span>
        <hr>
    @isset($avg)
    
        <div class="center-align">
            <h5><strong>Quality: </strong></h5>
            @if ($avg < 2)
                <a style="font-size: 250%" class="btn-large btn-floating red animated heartBeat"><strong>F</strong></a><br><br>
                <span style="font-size: 85%; border-radius: 25px;" class="red darken-2 white-text animated jackInTheBox delay-1s"><strong><i>  Horrible  </i></strong></span>
            @elseif ($avg < 3)
                <a style="font-size: 250%" class="btn-large btn-floating orange animated heartBeat delay-1s"><strong>C</strong></a><br><br>
                <span style="font-size: 85%; border-radius: 25px;" class="orange white-text animated jackInTheBox delay-1s"><strong><i>  Needs Improvement  </i></strong></span>
            @elseif ($avg < 4)
                <a style="font-size: 250%" class="btn-large btn-floating yellow black-text animated heartBeat"><strong>B</strong></a><br><br>
                <span style="font-size: 85%; border-radius: 25px;" class="yellow lighten-2 black-text animated jackInTheBox delay-1s"><strong><i>  Good  </i></strong></span>
            @elseif ($avg < 4.9)    
                <a style="font-size: 250%" class="btn-large btn-floating teal darken-3 animated heartBeat"><strong>A</strong></a><br><br>
                <span style="font-size: 85%; border-radius: 25px;" class="teal darken-3 white-text animated jackInTheBox delay-1s"><strong><i>  Amazing  </i></strong></span><br>
            @else
                <div style="text-align: center; vertical-align: middle;">
                    <a style="font-size: 400%" class="blue-text text-darken-3"><strong>A</strong></a><span><a class="btn btn-small btn-floating blue darken-3 animated heartBeat slow infinite" style="margin-left:10px; margin-bottom: 35px;"><i class="medium material-icons right white-text">star_border</i></a></span>
                </div>
                <span style="font-size: 85%; border-radius: 25px;" class="blue darken-3 white-text animated jackInTheBox delay-1s"><strong><i>  Off the charts!  </i></strong></span>
            @endif
        </div>
        <h5><small>Score: </small><strong>{{ $avg }}</strong><small> / 5.0</small></h5>
        <h5><small>Total Reviews: </small><strong>{{ $approved_count }}</strong></h5>
        <p>
            <h5><b>{{ $take_again_pct }}%</b><small> recommended this teacher.</small></h5>
            <div class="progress">
                <div class="determinate" style="width: {{ $take_again_pct }}%"></div>
            </div>
            <h5><b>{{ $mandatory_pct }}%</b><small> said attendance was important.</small></h5>
            <div class="progress red lighten-3">
                <div class="determinate red darken-3" style="width: {{ $mandatory_pct }}%"></div>
            </div>
        </p>
    @else
        <br><br><p class="center-align"><strong>No reviews posted yet.</strong></p><br><br>   
    @endisset
        
        <div style="margin-top: 25px;" class="center-align">
            <a href="/professors/{{ $professor->id }}/review" class="waves-effect waves-light btn red darken-1"><i class="material-icons yellow-text left">mode_edit</i>Post a Review</a>
        </div>
    </div>
    <div class="card-action center-align">
    
    
    <a href="/professors/{{ $professor->id }}/review" class="waves-effect waves-light btn red darken-1"><i class="material-icons yellow-text left">mode_edit</i>Post a Review</a>
    </div>
</div>  

<div class="center-align">
    {{-- Facebook Share Button --}}
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Your share button code -->
    <div class="fb-share-button"
        data-href="http://www.amarfaculty.com/professors/{{ $professor->id }}" 
        data-layout="button"
        data-size="large">
    </div>

    {{-- Facebook Share Button End --}}

</div>



@auth
<div class="row center-align">
    <div class="col s6">
        <a href="/professors/{{ $professor->id }}/edit" class="waves-effect waves-light btn" >Admin: Edit</a>
    </div>
    <div class="col s6">
        <form action="{{ route('professors.destroy', $professor->id) }}" method="post" onsubmit="return confirm('You Sure?');">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="DELETE">
            <button class="waves-effect waves-light btn red" type="submit">Admin: Delete</button>
            

        </form>
    </div>
</div>
@endauth 

