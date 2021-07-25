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
    <div class="card review-card animated fadeInDown delay-1s">
      <form method="post" action="{{ route('reviews.store') }}">
                            {{ csrf_field() }}
      
        <div class="card-content">
          <span class="card-title center-align red-text text-darken-2"><strong>Review</strong></span><br><br>
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
            <div class="input-field col s12">
              <input type="text" id="code" name="code" value="{{ old('code') }}" minlength="3" maxlength="10" class="validate" onkeyup="enableDisable()" required>
              <label for="code">Course Code [required]:</label>
            </div>
          

            <div class="row">
              <div class="col s3 l4"></div>
              <div class="col s6 l4">
                
                <div class="card center-align " id="emoji-card" style="padding: 5px; padding-top: 15px;">
                    <img id="emoji1" src="{{ asset('img/thinking.png') }}" style="height: 60px; width:60px;" alt="emoji">
                    <h5 id="emoji-heading" class="grey-text">Thinking...</h5>
                </div>
                
              </div>
              <div class="col s3 l4"></div>
            </div>

            <div class="input-field col s12">
              <label class="grey-text text-darken-2">Score (1 = Horrible, 5 = Amazing) [required]:</label><br><br>
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

            <div class="input-field col s12">
              <label class="grey-text text-darken-2">Attendance Important? [required]:</label><br><br>
                <div class="center-align">
                  <label class="btn grey darken-1" id="mand">
                    <input type="radio" name="att" id="att-mandatory" value="1" onclick='attendanceButtons()'>YES
                  </label>
                  <label class="btn grey darken-1" id="opt">
                    <input type="radio" name="att" id="att-optional" value="0" onclick='attendanceButtons()' required >NO
                  </label>
                </div>
            </div>

            <div class="input-field col s12">
              <label class="grey-text text-darken-2">Recommend to others? [required]:</label><br><br>
              <div class="center-align">
                <label class="btn grey darken-1" id="yestake">
                  <input type="radio" name="take-again" id="take-again-yes" value="1" onclick='recommendButtons()' required> YES  
                </label>
                <label class="btn grey darken-1" id="notake">
                  <input type="radio" name="take-again" id="take-again-no" value="0" onclick='recommendButtons()'> NO 
                </label>
              </div>
            </div>
            
            <div class="input-field col s12" style="margin-top: 40px;">
              <textarea id="description" name="description" class="materialize-textarea grey-text text-darken-2" placeholder="Be respectful!" maxlength="400">{{ old('description') }}</textarea>
              <label class="grey-text text-darken-2" for="description">Write a short review [optional]:</label><br>
            </div>

            <input name="professor_id" type="hidden" value="{{ $professor->id }}">

{{--            
            <div class="input-field col s12">
              <div class="g-recaptcha" data-sitekey="6LftIr8UAAAAAKHT6tZawtMViN49aw7u4CApQrlc"></div>
            </div>
            --}}

            <div class="input-field col s12 center-align">
              <button id="btnSubmit" type="submit" class="btn red darken-2" disabled>Post Review<i class="material-icons right">send</i></button>
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
        
        <label>Rate this professor out of 5: (1 = Poor, 5 = Amazing) <small class="text-danger">[required]</small></label>
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
        <button id="btnSubmit" type="submit" class="button">Post Review.</button>
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
    document.getElementById("emoji-heading").className = "red-text text-darken-2";
    
    document.getElementById("one").className = "btn red darken-2 btn-large animated flip";
    document.getElementById("two").className = "btn white red-text text-darken-2";
    document.getElementById("three").className = "btn white red-text text-darken-2";
    document.getElementById("four").className = "btn white red-text text-darken-2";
    document.getElementById("five").className = "btn white red-text text-darken-2";

  } else if (document.getElementById("rating2").checked) { 

    document.getElementById("emoji1").src = "{{ asset('img/rating_2.png') }}";
    document.getElementById("emoji1").className = "animated swing";

    document.getElementById("emoji-heading").innerHTML = "Poor!";
    document.getElementById("emoji-heading").className = "red-text text-darken-2";

    document.getElementById("one").className = "btn red darken-2";
    document.getElementById("two").className = "btn red darken-2 btn-large animated flip";
    document.getElementById("three").className = "btn white red-text text-darken-2";
    document.getElementById("four").className = "btn white red-text text-darken-2";
    document.getElementById("five").className = "btn white red-text text-darken-2";

  } else if (document.getElementById("rating3").checked) { 

    document.getElementById("emoji1").src = "{{ asset('img/rating_3.png') }}";
    document.getElementById("emoji1").className = "animated tada";
    
    document.getElementById("emoji-heading").innerHTML = "Good!";
    document.getElementById("emoji-heading").className = "red-text text-darken-2";
    
    document.getElementById("one").className = "btn red darken-2";
    document.getElementById("two").className = "btn red darken-2";
    document.getElementById("three").className = "btn red darken-2 btn-large animated flip";
    document.getElementById("four").className = "btn white red-text text-darken-2";
    document.getElementById("five").className = "btn white red-text text-darken-2";
    
  } else if (document.getElementById("rating4").checked) { 
    document.getElementById("emoji1").src = "{{ asset('img/rating_4.png') }}";
    document.getElementById("emoji1").className = "animated bounceIn";
    
    document.getElementById("emoji-heading").innerHTML = "Great!";
    document.getElementById("emoji-heading").className = "red-text text-darken-2";
    
    document.getElementById("one").className = "btn red darken-2";
    document.getElementById("two").className = "btn red darken-2";
    document.getElementById("three").className = "btn red darken-2";
    document.getElementById("four").className = "btn red darken-2 btn-large animated flip";
    document.getElementById("five").className = "btn white red-text text-darken-2";
    
  } else if (document.getElementById("rating5").checked) { 
    document.getElementById("emoji1").src = "{{ asset('img/rating_5.png') }}";
    document.getElementById("emoji1").className = "animated heartBeat";
    
    document.getElementById("emoji-heading").innerHTML = "Amazing!";
    document.getElementById("emoji-heading").className = "red-text text-darken-2";
    
    document.getElementById("one").className = "btn red darken-2";
    document.getElementById("two").className = "btn red darken-2";
    document.getElementById("three").className = "btn red darken-2";
    document.getElementById("four").className = "btn red darken-2";
    document.getElementById("five").className = "btn red darken-2 btn-large animated flip";
  
  }
  enableDisable()
}

function attendanceButtons() {
  if (document.getElementById("att-optional").checked) {
    
    document.getElementById("opt").className = "btn red darken-2 btn-large animated zoomIn faster";
    document.getElementById("mand").className = "btn white red-text text-darken-2";

  } else if (document.getElementById("att-mandatory").checked) { 

    document.getElementById("opt").className = "btn white red-text text-darken-2";
    document.getElementById("mand").className = "btn red darken-2 btn-large animated zoomIn faster";

  } 

  enableDisable()
  
}

function recommendButtons() {
  if (document.getElementById("take-again-yes").checked) {
    
    document.getElementById("yestake").className = "btn red darken-2 btn-large animated zoomIn faster";
    document.getElementById("notake").className = "btn white red-text text-darken-2";

  } else if (document.getElementById("take-again-no").checked) { 

    document.getElementById("yestake").className = "btn white red-text text-darken-2";
    document.getElementById("notake").className = "btn red darken-2 btn-large animated zoomIn faster";

  } 

  enableDisable()
}

function enableDisable() {
    //Reference the Button.
    var btnSubmit = document.getElementById("btnSubmit");
    var score1 = document.getElementById("rating1")
    var score2 = document.getElementById("rating2")
    var score3 = document.getElementById("rating3")
    var score4 = document.getElementById("rating4")
    var score5 = document.getElementById("rating5")
    var txtCode = document.getElementById("code")
    var atMnd = document.getElementById("att-mandatory")
    var atOpt = document.getElementById("att-optional")
    var taYes = document.getElementById("take-again-yes")
    var taNo = document.getElementById("take-again-no")

    //Verify the TextBox value.
    if ((txtCode.value.length >= 3) && (score1.checked || score2.checked || score3.checked || score4.checked || score5.checked) && (atOpt.checked || atMnd.checked) && (taYes.checked || taNo.checked)) {
        //Enable the TextBox when TextBox has value.
        btnSubmit.disabled = false;
   
    } else {
        //Disable the TextBox when TextBox is empty.
        btnSubmit.disabled = true;

    }
};

</script>
@endsection