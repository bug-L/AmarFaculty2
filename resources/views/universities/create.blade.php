@extends('layouts.app')

@section('title', 'Add a new university - ')

@section('content')

  <h1>Add New University</h1>
  <form method="post" action="{{ route('universities.store') }}">
                              {{ csrf_field() }}
      <div class="form-group">
          <label for="university-name">Name:<span class="required">*</span></label>
          <input      placeholder="Enter name"
                      id="university-name"
                      required
                      name="name"
                      spellcheck="false"
                      class="form-control"
                        />
      </div>

      <div class="form-group">
          <label for="university-abbr">Abbreviation:<span class="required">*</span></label>
          <input      placeholder="Enter abbreviation"
                      id="university-abbr"
                      required
                      name="abbr"
                      spellcheck="false"
                      class="form-control"
                        />
      </div>

      <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Submit"/>
      </div>
  </form>
  

@endsection

