@extends('layouts.app')

@section('title')
Edit {{ $professor->name }} | 
@endsection

@section('links')
@endsection

@section('content')
<div class="row">
    <div class="col s12 l8 push-l2">
    
      <div class="card grey lighten-5">
        <form method="post" action="{{ route('professors.update', [$professor->id]) }}" onsubmit="return confirm('Save Changes?');">
                              {{ csrf_field() }}
        
          <div class="card-content">
            <span class="card-title center-align grey-text text-darken-2"><strong>Edit Faculty</strong></span><br><br>
          
            <div class="row">
              <div class="col s10 push-s1 m8 push-m2 l6 push-l3">
                <div class="center-align">
                    <img class="responsive-img" src="{{ asset('img/professor-create.png') }}" alt="Edit Faculty">
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
                <input type="text" id="name" name="name" value="{{ $professor->name }}" minlength="5" maxlength="60" class="validate" required>
                <label for="name">Faculty Name [required]</label>
              </div>
              
              <div class="input-field col s12">
                <input type="text" id="initials" name="initials" value="{{ $professor->initials }}" maxlength="5" class="validate">
                <label for="name">Faculty Initials [optional]</label>
              </div>
            
              <div class="input-field col s12 m6">
                <select id="professor-university" name="university_id" required>
                  <option value="" disabled>Select a University</option>
                  @foreach($universities as $university)
                    @if($university->id == $professor->university->id)
                        <option value="{{ $university->id }}" selected>{{ $university->name }}</option>
                    @else
                        <option value="{{ $university->id }}">{{ $university->name }}</option>
                    @endif
                  @endforeach
                </select>
                <label>University:</label>
              </div>

              <div class="input-field col s12 m6">
                <select id="professor-department" name="department_id" required>
                  <option value="" disabled>Select a Department</option>
                  @foreach($departments as $department)
                    @if($department->id == $professor->department->id)
                        <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                    @else
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endif
                  @endforeach
                </select>
                <label>Department:</label>
              </div>

              <input type="hidden" name="_method" value="put">

              <div class="input-field col s12 center-align">
                <button type="submit" class="btn blue darken-3">Update Faculty</button>
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

