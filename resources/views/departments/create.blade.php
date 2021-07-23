@extends('layouts.app')

@section('title', 'Add a new department - ')

@section('content')

  <h1>Add New Department</h1>
  <form method="post" action="{{ route('departments.store') }}" onsubmit="return confirm('Save Changes?');">
                              {{ csrf_field() }}
      <div class="form-group">
          <label for="department-name">Name:<span class="required">*</span></label>
          <input      placeholder="Enter name"
                      id="department-name"
                      required
                      name="name"
                      spellcheck="false"
                      class="form-control"
                        />
      </div>

      <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Submit"/>
      </div>
  </form>
  

@endsection

