@extends('layouts.app')

@section('title')
Search results for '{{ old('q') }}' | 
@endsection


@section('links')

@endsection

@section('styles')


@endsection

@section('content')

    @include('partials.searchbar')
    
    <blockquote>
        <h1 class="grey-text text-darken-2 search-result-text">Search results for '{{ old('q') }}' :</h1>
    </blockquote>
    
    @if($professors->count() > 0)
       
        <div class="row">
            <div class="col s12 m10 push-m1 l8 push-l2">

                <ul id="review-list" class="collection">
                    @foreach($professors as $professor)
                    
                    <li class="collection-item avatar search-results" style="background-image: url({{ asset('img/searchbar_background.png') }});">
                        <a href="/professors/{{ $professor->id }}">
                        <i class="material-icons circle white search-result-icon red-text text-lighten-1">school</i>
                        <span class="title grey-text text-darken-2 search-name">{{ $professor->name }}</span><br>
                        
                        <p class="prof-uni-dept grey-text text-darken-1">
                            {{ $professor->department->name }},<br>
                            {{ $professor->university->name }}
                        </p>
                        
                        <span class="secondary-content yellow-text text-darken-1"><br><i class="material-icons">rate_review</i></span>
                        </a>        
                    </li>
                    
                    @endforeach
                </ul>
            </div>  
        </div>
       
        <p class="red-text text-darken-4 center-align">
            <i class="material-icons" style="vertical-align: middle;">sentiment_dissatisfied</i>
            Can't find your teacher?
            <a href="/professors/create"> Click here to add.</a>
        </p>
        
    @else
        
    <div class="row">
        
        <div class="col s12 m8 push-m2 l8 push-l2">        
            <p class="red-text text-darken-2" >
                
                <i class="material-icons left">error_outline</i>
                 Nothing found!
                <a href="/professors/create"> Click here to add new faculty.</a>
            </p>
        </div>
    </div>
    @endif
    
@endsection

@section('scripts')
<script>

$(function(){
    $("#review-list li:even").addClass("grey lighten-4");
    $("#review-list li:even i").removeClass("white text-accent-4");
    $("#review-list li:even i").addClass("grey lighten-4 text-darken-3");
    $("#review-list li:even p").removeClass("text-lighten-2");
    $("#review-list li:even p").addClass("text-darken-1");
    $("#review-list li:even span").removeClass("light-blue-text text-accent-4");
    $("#review-list li:even span").addClass("text-darken-3");
    
    
});




</script>

{{-- initialize select materialize --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
});
</script>
@endsection