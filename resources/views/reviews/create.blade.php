@extends('layouts.app')

@section('links')

{{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}
@endsection

@section('title')
Post a review for {{ $professor->name }} | 
@endsection

@section('content')

<div class="row">
  <div class="col s12 l8 push-l2">
    <div class="card grey lighten-5">
      <form method="post" action="{{ route('reviews.store') }}">
                            {{ csrf_field() }}
      
        <div class="card-content">
          <span class="card-title center-align grey-text text-darken-2"><strong>Review</strong></span><br><br>
          <p>
          @if($errors->any())
            <small style="color: red">
            {!! $errors->first() !!}            
            </small>
          @endif
          </p>
          <p>
            <strong>{{ $professor->name }}</strong><br>
            {{ $professor->department->name }}, {{ $professor->university->name }}<br>
          </p>
          <div class="row">
            <div class="input-field col s12 animated fadeInDown">
              <input type="text" id="code" name="code" value="{{ old('code') }}" minlength="3" maxlength="10" class="validate" required>
              <label for="code">Course Code [required]:</label>
            </div>
          

            <div class="row">
              <div class="col s3 l4"></div>
              <div class="col s6 l4">
                
                <div class="card center-align animated fadeIn delay-1s" id="emoji-card" style="padding: 5px; padding-top: 15px;">
                    <img id="emoji1" src="{{ asset('img/thinking.png') }}" style="height: 60px; width:60px;" alt="emoji">
                    <h5 id="emoji-heading" class="grey-text">Thinking...</h5>
                </div>
                
              </div>
              <div class="col s3 l4"></div>
            </div>

            <div class="input-field col s12 animated fadeInDown delay-1s">
              <label>Score (1 = Horrible, 5 = Excellent) [required]:</label><br><br>
              <div class="center-align">
                <label id="one" class="btn grey darken-1">
                  <input type="radio" name="rating" id="rating1" value="1" onclick='clearButtons()' required> 1
                </label>
                <label id="two" class="btn grey darken-1">
                  <input type="radio" name="rating" id="rating2" value="2" onclick='clearButtons()'> 2
                </label>
                <label id="three" class="btn grey darken-1">
                  <input type="radio" name="rating" id="rating3" value="3" onclick='clearButtons()'> 3
                </label>
                <label id="four" class="btn grey darken-1">
                  <input type="radio" name="rating" id="rating4" value="4" onclick='clearButtons()'> 4
                </label>
                <label id="five" class="btn grey darken-1">
                  <input type="radio" name="rating" id="rating5" value="5" onclick='clearButtons()'> 5
                </label>
              </div>
            </div>

            <div class="input-field col s12 animated fadeInDown delay-2s">
              <label>Was Class Attendance Important? [required]:</label><br><br>
                <div class="center-align">
                  <label class="btn grey darken-1" id="mand">
                    <input type="radio" name="att" id="att-mandatory" value="1" onclick='attendanceButtons()'>YES
                  </label>
                  <label class="btn grey darken-1" id="opt">
                    <input type="radio" name="att" id="att-optional" value="0" onclick='attendanceButtons()' required >NO
                  </label>
                </div>
            </div>

            <div class="input-field col s12 animated fadeInDown delay-3s">
              <label>Recommend Faculty to Other Students? [required]:</label><br><br>
              <div class="center-align">
                <label class="btn grey darken-1" id="yestake">
                  <input type="radio" name="take-again" id="take-again-yes" value="1" onclick='recommendButtons()' required> YES  
                </label>
                <label class="btn grey darken-1" id="notake">
                  <input type="radio" name="take-again" id="take-again-no" value="0" onclick='recommendButtons()'> NO 
                </label>
              </div>
            </div>
            
            <div class="input-field col s12 animated fadeInDown delay-4s" style="margin-top: 40px;">
              <textarea id="description" name="description" class="materialize-textarea grey-text text-darken-2" placeholder="Be respectful!" maxlength="400">{{ old('description') }}</textarea>
              <label for="description">Write a short description [optional]:</label><br>
            </div>

            <input name="professor_id" type="hidden" value="{{ $professor->id }}">

{{--            
            <div class="input-field col s12">
              <div class="g-recaptcha" data-sitekey="6LftIr8UAAAAAKHT6tZawtMViN49aw7u4CApQrlc"></div>
            </div>
            --}}

            <div class="input-field col s12 center-align">
              <button type="submit" class="btn blue darken-3">Post Review<i class="material-icons right">send</i></button>
            </div>
          </div>
        
        </div>
      </form>
     
    </div>
  </div>
</div>

@endsection

@section('content1')
<div class="card">      
  <form method="post" action="{{ route('reviews.store') }}">
                          {{ csrf_field() }}
    <ul class="form-list">
      @if($errors->any())
        <small style="color: red">
        {!! $errors->first() !!}            
        </small>
      @endif
      
      <h5 class="grey-text">Post a review for {{ $professor->name }}</h5><br>
      
      <div class="row justify-content-md-center">
        <div class="col">
          <div class="card text-center mb-3">
              <img id="emoji1" class="rounded mx-auto d-block mt-1" src="{{ asset('img/thinking.png') }}" style="height: 60px; width:60px;" alt="emoji">
              <h3 id="emoji-heading" class="text-secondary">Thinking...</h3>
          </div>
        </div>  
      </div>
      
      <li class="form-list__row">
      <input type="text" id="code" name="code" value="{{ old('code') }}" minlength="3" maxlength="10" class="validate" required>
              <label for="code">Course Code (required)</label>
      </li>
      <li class="form-list__row">
        
        <label>Rate this professor out of 5: (1 = Poor, 5 = Excellent) <small class="text-danger">[required]</small></label>
        <div class="btn-group special btn-group-toggle">
          <label id="one" class="btn btn-lg btn-outline-primary">
            <input type="radio" name="rating" id="rating1" value="1" onclick='clearButtons()' required> 1
          </label>
          <label id="two" class="btn btn-lg btn-outline-primary">
            <input type="radio" name="rating" id="rating2" value="2" onclick='clearButtons()'> 2
          </label>
          <label id="three" class="btn btn-lg btn-outline-primary">
            <input type="radio" name="rating" id="rating3" value="3" onclick='clearButtons()'> 3
          </label>
          <label id="four" class="btn btn-lg btn-outline-primary">
            <input type="radio" name="rating" id="rating4" value="4" onclick='clearButtons()'> 4
          </label>
          <label id="five" class="btn btn-lg btn-outline-primary">
            <input type="radio" name="rating" id="rating5" value="5" onclick='clearButtons()'> 5
          </label>
        </div>
      </li>

      <li class="form-list__row">
        <label>Attendance was: <small class="text-danger">[required]</small></label>
        <div class="btn-group special btn-group-toggle btn-group-justified" data-toggle="buttons">
          <label class="btn btn-lg btn-outline-primary">
            <input type="radio" name="att" id="att-optional" value="0" required >OPTIONAL
          </label>
          <label class="btn btn-lg btn-outline-danger">
            <input type="radio" name="att" id="att-mandatory" value="1">MANDATORY
          </label>
        </div>
      </li>
      
      <li class="form-list__row">
        <label>Would you take this professor again? <small class="text-danger">[required]</small></label>
        <div class="btn-group special btn-group-toggle btn-group-justified" data-toggle="buttons">
          <label class="btn btn-lg btn-outline-primary">
            <input type="radio" name="take-again" id="take-again-yes" value="1" required> YES  
          </label>
          <label class="btn btn-lg btn-outline-danger">
            <input type="radio" name="take-again" id="take-again-no" value="0"> NO 
          </label>
        </div>
      </li>

      <li class="form-list__row">
        <label>Description: <small class="text-info">[optional]</small></label>
        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Say something about this professor. Be nice and respectful." maxlength="400">{{ old('description') }}</textarea>
      </li>
      <input name="professor_id" type="hidden" value="{{ $professor->id }}">
      
      <li class="form-list row">
        <div class="g-recaptcha" data-sitekey="6LftIr8UAAAAAKHT6tZawtMViN49aw7u4CApQrlc"></div>
      </li>
      
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
    document.getElementById("emoji1").className = "animated shake";

    document.getElementById("emoji-heading").innerHTML = "Horrible!";
    document.getElementById("emoji-heading").className = "red-text";
    
    document.getElementById("one").className = "btn red btn-large animated flip";
    document.getElementById("two").className = "btn white red-text";
    document.getElementById("three").className = "btn white red-text";
    document.getElementById("four").className = "btn white red-text";
    document.getElementById("five").className = "btn white red-text";

  } else if (document.getElementById("rating2").checked) { 

    document.getElementById("emoji1").src = "{{ asset('img/rating_2.png') }}";
    document.getElementById("emoji1").className = "animated swing";

    document.getElementById("emoji-heading").innerHTML = "Poor!";
    document.getElementById("emoji-heading").className = "orange-text";

    document.getElementById("one").className = "btn orange";
    document.getElementById("two").className = "btn orange btn-large animated flip";
    document.getElementById("three").className = "btn white orange-text";
    document.getElementById("four").className = "btn white orange-text";
    document.getElementById("five").className = "btn white orange-text";

  } else if (document.getElementById("rating3").checked) { 

    document.getElementById("emoji1").src = "{{ asset('img/rating_3.png') }}";
    document.getElementById("emoji1").className = "animated tada";
    
    document.getElementById("emoji-heading").innerHTML = "Good!";
    document.getElementById("emoji-heading").className = "yellow-text text-darken-2";
    
    document.getElementById("one").className = "btn yellow darken-2";
    document.getElementById("two").className = "btn yellow darken-2";
    document.getElementById("three").className = "btn yellow darken-2 btn-large animated flip";
    document.getElementById("four").className = "btn white yellow-text";
    document.getElementById("five").className = "btn white yellow-text";
    
  } else if (document.getElementById("rating4").checked) { 
    document.getElementById("emoji1").src = "{{ asset('img/rating_4.png') }}";
    document.getElementById("emoji1").className = "animated bounceIn";
    
    document.getElementById("emoji-heading").innerHTML = "Great!";
    document.getElementById("emoji-heading").className = "green-text";
    
    document.getElementById("one").className = "btn green";
    document.getElementById("two").className = "btn green";
    document.getElementById("three").className = "btn green";
    document.getElementById("four").className = "btn green btn-large animated flip";
    document.getElementById("five").className = "btn white green-text";
    
  } else if (document.getElementById("rating5").checked) { 
    document.getElementById("emoji1").src = "{{ asset('img/rating_5.png') }}";
    document.getElementById("emoji1").className = "animated heartBeat";
    
    document.getElementById("emoji-heading").innerHTML = "Excellent!";
    document.getElementById("emoji-heading").className = "blue-text";
    
    document.getElementById("one").className = "btn blue darken-2";
    document.getElementById("two").className = "btn blue darken-2";
    document.getElementById("three").className = "btn blue darken-2";
    document.getElementById("four").className = "btn blue darken-2";
    document.getElementById("five").className = "btn blue darken-2 btn-large animated flip";
  
  }
}

function attendanceButtons() {
  if (document.getElementById("att-optional").checked) {
    
    document.getElementById("opt").className = "btn teal darken-2 btn-large animated zoomIn faster";
    document.getElementById("mand").className = "btn white teal-text text-darken-2";

  } else if (document.getElementById("att-mandatory").checked) { 

    document.getElementById("opt").className = "btn white cyan-text text-darken-3";
    document.getElementById("mand").className = "btn cyan darken-3 btn-large animated zoomIn faster";

  } 
  
}

function recommendButtons() {
  if (document.getElementById("take-again-yes").checked) {
    
    document.getElementById("yestake").className = "btn light-blue darken-2 btn-large animated zoomIn faster";
    document.getElementById("notake").className = "btn white light-blue-text text-darken-2";

  } else if (document.getElementById("take-again-no").checked) { 

    document.getElementById("yestake").className = "btn white red-text";
    document.getElementById("notake").className = "btn red lighten-2 btn-large animated zoomIn faster";

  } 
}

</script>
@endsection