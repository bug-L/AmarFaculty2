@extends('layouts.app')

@section('links')
<link href="{{ asset('css/test.css') }}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
@endsection

@section('title')
Edit Review: #{{ $review->id }}
@endsection

@section('content')
<div class="row">
    <div class="col s12 l8 push-l2">
    
      <div class="card grey lighten-5">
        <form method="post" action="{{ route('reviews.update', [$review->id]) }}" onsubmit="return confirm('You Sure?');">
                              {{ csrf_field() }}
        
          <div class="card-content">
            <span class="card-title center-align grey-text text-darken-2"><strong>Edit Review</strong></span><br><br>
            <p>
            @if($errors->any())
              <small style="color: red">
              {!! $errors->first() !!}            
              </small>
            @endif
            </p>
            <div class="row">
              <div class="input-field col s12">
                <input type="text" id="code" name="code" value="{{ $review->course_code }}" minlength="3" maxlength="10" class="validate" required>
                <label for="code">Course Code [required]</label>
              </div>
              
              <div class="input-field col s12" style="margin-top: 40px;">
                <textarea id="description" name="description" class="materialize-textarea grey-text text-darken-2" placeholder="Be respectful!" maxlength="400">{{ $review->description }}</textarea>
                <label for="description">Write a short description [optional]:</label><br>
              </div>

              <div class="col s12">
                <label>
                  @if ($review->offensive == '1')
                    <input type="checkbox" name="offensive" value="1" checked>
                  @else
                    <input type="checkbox" name="offensive" value="1">
                  @endif 
                    <span>Offensive</span>
                </label>
              </div>

              <input type="hidden" name="_method" value="put">

              <div class="input-field col s12 center-align">
                <button type="submit" class="btn blue darken-3">Update Review</button>
              </div>
            </div>
          
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection


@section('scripts')
{{-- Select Options do not render without this due to Materialize: --}}
<script>
$(document).ready(function(){
    $('select').formSelect();
  });
</script>
@endsection



@section('content1')

<div class="card m-4 p-4">      
  <form method="post" action="{{ route('reviews.update', [$review->id]) }}" onsubmit="return confirm('You Sure?');">
                          {{ csrf_field() }}
    <ul class="form-list">
      @if($errors->any())
        <small style="color: red">
        {!! $errors->first() !!}            
        </small>
      @endif
      
      <h5 style="color:#686868;">Edit review #{{ $review->id }} for {{ $review->professor->name }}</h5><br>
      
            
      <li class="form-list__row">
        <label>Course Code: <small class="text-danger">[required]</small></label>
        <input type="text" class="form-control" id="code" name="code" placeholder="Example: CS116, ACC213, BUS161" value="{{ $review->course_code }}" required>
      </li>

      <li class="form-list__row">
        <label>Description: <small class="text-info">[optional]</small></label>
        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Say something about this professor. Be nice and respectful." >{{ $review->description }}</textarea>
      </li>

      <input type="hidden" name="_method" value="put">

      <li>
        <button type="submit" class="button">Post Review.</button>
      </li>
    </ul>
  </form>
</div>
@endsection

@section('scripts')


<script>


function clearButtons() {
  if (document.getElementById("rating1").checked) {
    
    document.getElementById("emoji1").src = "{{ asset('img/rating_1.png') }}";

    document.getElementById("emoji-heading").innerHTML = "Terrible!";
    document.getElementById("emoji-heading").className = "text-danger";
    
    document.getElementById("one").className = "btn btn-lg btn-danger text-white";
    document.getElementById("two").className = "btn btn-lg btn-outline-danger";
    document.getElementById("three").className = "btn btn-lg btn-outline-danger";
    document.getElementById("four").className = "btn btn-lg btn-outline-danger";
    document.getElementById("five").className = "btn btn-lg btn-outline-danger";

  } else if (document.getElementById("rating2").checked) { 

    document.getElementById("emoji1").src = "{{ asset('img/rating_2.png') }}";
    
    document.getElementById("emoji-heading").innerHTML = "Poor!";
    document.getElementById("emoji-heading").className = "text-warning";
    
    document.getElementById("one").className = "btn btn-lg btn-outline-warning";
    document.getElementById("two").className = "btn btn-lg btn-warning text-dark";
    document.getElementById("three").className = "btn btn-lg btn-outline-warning";
    document.getElementById("four").className = "btn btn-lg btn-outline-warning";
    document.getElementById("five").className = "btn btn-lg btn-outline-warning";

  } else if (document.getElementById("rating3").checked) { 

    document.getElementById("emoji1").src = "{{ asset('img/rating_3.png') }}";
    
    document.getElementById("emoji-heading").innerHTML = "Good!";
    document.getElementById("emoji-heading").className = "text-info";
    
    document.getElementById("one").className = "btn btn-lg btn-outline-info";
    document.getElementById("two").className = "btn btn-lg btn-outline-info";
    document.getElementById("three").className = "btn btn-lg btn-info text-white";
    document.getElementById("four").className = "btn btn-lg btn-outline-info";
    document.getElementById("five").className = "btn btn-lg btn-outline-info";
    
  } else if (document.getElementById("rating4").checked) { 
    document.getElementById("emoji1").src = "{{ asset('img/rating_4.png') }}";
    
    document.getElementById("emoji-heading").innerHTML = "Great!";
    document.getElementById("emoji-heading").className = "text-primary";
    
    document.getElementById("one").className = "btn btn-lg btn-outline-primary";
    document.getElementById("two").className = "btn btn-lg btn-outline-primary";
    document.getElementById("three").className = "btn btn-lg btn-outline-primary";
    document.getElementById("four").className = "btn btn-lg btn-primary text-white";
    document.getElementById("five").className = "btn btn-lg btn-outline-primary";
    
  } else if (document.getElementById("rating5").checked) { 
    document.getElementById("emoji1").src = "{{ asset('img/rating_5.png') }}";
    
    document.getElementById("emoji-heading").innerHTML = "Excellent!";
    document.getElementById("emoji-heading").className = "text-success";
    
    document.getElementById("one").className = "btn btn-lg btn-outline-success";
    document.getElementById("two").className = "btn btn-lg btn-outline-success";
    document.getElementById("three").className = "btn btn-lg btn-outline-success";
    document.getElementById("four").className = "btn btn-lg btn-outline-success";
    document.getElementById("five").className = "btn btn-lg btn-success text-white";
  
  }
}

</script>
@endsection