@extends('layouts.app')

@section('title')
Edit Department: {{ $department->name }} - 
@endsection

@section('content')

  <h1>Edit {{ $department->name }}</h1>
  <form method="post" action="{{ route('departments.update', $department->id) }}" onsubmit="return confirm('Save Changes?');">
                              {{ csrf_field() }}
      <div class="form-group">
          <label for="department-name">Name:<span class="required">*</span></label>
          <input      placeholder="Enter name"
                      id="department-name"
                      required
                      name="name"
                      spellcheck="false"
                      class="form-control"
                      value="{{ $department->name }}"
                        />
      </div>

      <input type="hidden" name="_method" value="put">

      <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Submit"/>
      </div>
  </form>
  

@endsection

