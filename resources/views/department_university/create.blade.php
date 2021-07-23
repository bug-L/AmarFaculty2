@extends('layouts.app')

@section('title', 'Add a new department - ')

@section('content')

  <h1>Add New University Department Relation</h1>
  <form method="post" action="{{ route('department_university.store') }}" onsubmit="return confirm('Sure?');">
                              {{ csrf_field() }}
    <div class="form-row">
        <div class="form-group p-2">
            <label>University:</label>
            <select class="form-control" name="university_id" id="university_id" required >
                <option disabled selected>Select a university.</option>
                @foreach($universities as $university)
                <option value="{{ $university->id }}">{{ $university->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group p-2">
            <label>Department:</label>
            <select class="form-control" name="department_id" id="department_id" required >
                <option disabled selected>Select a department.</option>
                @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group p-2">
            <br><input type="submit" class="btn btn-primary" value="Submit"/>
        </div>
    </div>
  </form>
  

@endsection

