@extends('layouts.app')

@section('title', 'Mass Create Professors - ')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Enter one name each line</h2>
            <form method="post" action="{{ route('massCreateProfessors') }}" onsubmit="return confirm('Sure?');">
                {{ csrf_field() }}
                
                <textarea style="width: 100%;" name="names" rows="10"></textarea>
                
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
               
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>

            @if($errors->any())
                <small style="color: red">
                {!! $errors->first() !!}            
                </small>
            @endif
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
  
  console.log(selectedUniversity);
  for (i = 0; i < uni_dept.length; i++) {

    //find the university based on selected university
    if (uni_dept[i].university_id == selectedUniversity) {
      
      for (j = 0; j < uni_dept[i].departments.length; j++) {
        document.getElementById("professor-department").innerHTML += '<option value="' + uni_dept[i].departments[j].department_id + 
                                                                    '">' + uni_dept[i].departments[j].department_name + '</option>';
        console.log(uni_dept[i].departments[j].department_name);
      }
      break;
    }
//    console.log(uni_dept[i].departments);
  }
  //console.log(uni_dept);
  //Materialize initialize select objects:
  var elems = document.querySelectorAll('select');
  var instances = M.FormSelect.init(elems);
}
</script>
@endsection