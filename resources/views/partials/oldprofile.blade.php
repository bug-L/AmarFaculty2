<!-- CSS -->
<style>
.certificate {
  border: 1px solid;
  padding: 10px;
  box-shadow: 5px 5px 15px 15px #888888;
 
  background-color: #FFF9BA;
  background-image: url("{{ asset('/img/certificate.jpg') }}");
  background-size: cover;
}
.cardsection {
    box-shadow: 5px 5px 15px 15px #888888;
}
.underline{
border-bottom: 1px solid #868e96;
width: 100%;
display: block;
} 
.reviews{
    font-family: verdana, arial;
}
</style>
<!-- END OF CSS -->
<div class="certificate text-center text-dark">
    
    <hr>
    <h3>Certified Review For</h3>
    <h2>{{ $professor->name }}</h2>
    <p>Department of {{ $professor->department->name }}<br>
    {{ $professor->university->name }}<br></p>
    @isset($avg)
    <h4>Overall Score:</h4>
    <h2>{{ $avg }} out of 5.00<br>
        @if ($approved_count == 1)
        <small>from 1 review.</small></h2>
        @else 
        <small>from {{ $approved_count }} reviews.</small></h2>
        @endif
    @else
    <a href="/professors/{{ $professor->id }}/review"><h4>Post a review</h4></a>
    @endisset
    <p>proudly presented by www.amarguru.com</p>
    <hr>
</div>

<div class="card bg-dark cardsection">
    <div class="card-body">
    @isset($avg)
    <div class="progress">
        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ $take_again_pct }}%" aria-valuenow="{{ $take_again_pct }}" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="text-center">
        <p class="text-light"><span style="font-size: 150%;"><b>{{ $take_again_pct }}%</b></span> of students would take this professor again.</p>
    </div>
    @endisset
    <div class="text-center">
        <a href="/professors/{{ $professor->id }}/review" class="btn btn-outline-success" >Post a review for this professor</a>
        @auth
            <div class="mt-2" id="admin">
                <a href="/professors/{{ $professor->id }}/edit" class="btn btn-outline-success" >Admin: Edit professor</a>
                <form class="mt-2" action="{{ route('professors.destroy', $professor->id) }}" method="post" onsubmit="return confirm('You Sure?');">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-outline-danger" type="submit">Admin: Delete Professor</button>
                </form><br>
            </div>
        @endauth 
    </div>
    </div>
</div>

<hr>