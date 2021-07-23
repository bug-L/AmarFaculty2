@extends('layouts.app')

@section('title', 'Add New Faculty | ')

@section('links')

{{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}
@endsection

@section('content')

  <div class="row">
    <div class="col s12 l8 push-l2">
      
    
      <div class="card grey lighten-5">
        <form method="post" action="{{ route('professors.store') }}">
                              {{ csrf_field() }}
        
          <div class="card-content">
            <span class="card-title center-align grey-text text-darken-2"><strong>Add New Faculty</strong></span><br><br>
          
            <div class="row">
             
              <div class="col s10 push-s1 m8 push-m2 l6 push-l3">
                <div class="center-align">
                    <img class="responsive-img" src="{{ asset('img/professor-create.png') }}" alt="Add Faculty">
                </div>
              </div>
            </div>

            <p>
            @if($errors->any())
              <small style="color: red">
              {!! $errors->first() !!}            
              </small>
            @endif
            </p>
            <div class="row">
              <div class="input-field col s12">
                <input type="text" id="name" name="name" value="{{ old('name') }}" minlength="5" maxlength="60" class="validate" required>
                <label for="name">Faculty Name [required]</label>
              </div>
              
              <div class="input-field col s12">
                <input type="text" id="initials" name="initials" value="{{ old('initials') }}" maxlength="5" class="validate">
                <label for="initials">Faculty Initials [optional]</label>
              </div>
           
              <div class="input-field col s12 m6">
                <select id="professor-university" name="university_id" onchange="refreshDepartments()" required>
                  <option value="" disabled selected>Select a University</option>
                  @foreach($uni_dept as $university)
                  <option value="{{ $university['university_id'] }}">{{ $university['university_name'] }}</option>
                  @endforeach
                </select>
                <label>University:</label>
              </div>

              <div class="input-field col s12 m6">
                <select id="professor-department" name="department_id" required>
                  <option value="" disabled selected>Select a Department</option>                
                </select>
                <label>Department:</label>
              </div>

{{-- Google Captcha 
              <div class="input-field col s12">
                <div class="g-recaptcha" data-sitekey="6LftIr8UAAAAAKHT6tZawtMViN49aw7u4CApQrlc"></div>
              </div>
--}}
              <div class="input-field col s12 center-align">
                <button id="submit_button" type="submit" class="btn blue darken-3"><i class="material-icons left">add</i>Add New Faculty</button>
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

{{-- Uni-department update select --}}
<script>
function refreshDepartments() {
  document.getElementById("professor-department").innerHTML = '<option value="" disabled selected>Select a Department</option>  ';
  
  var uni_dept = @json($uni_dept);

  var i;
  var j;

  var e = document.getElementById("professor-university");  
  var selectedUniversity = e.options[e.selectedIndex].value; //university ID
  
  for (i = 0; i < uni_dept.length; i++) {

    //find the university based on selected university
    if (uni_dept[i].university_id == selectedUniversity) {
      
      for (j = 0; j < uni_dept[i].departments.length; j++) {
        document.getElementById("professor-department").innerHTML += '<option value="' + uni_dept[i].departments[j].department_id + 
                                                                    '">' + uni_dept[i].departments[j].department_name + '</option>';
      
      }
      break;
    }
  }
  //Materialize initialize select objects:
  var elems = document.querySelectorAll('select');
  var instances = M.FormSelect.init(elems);
}
</script>

{{--Prevent multiple form submission by disabling submit button for 5 seconds--}}


@endsection
