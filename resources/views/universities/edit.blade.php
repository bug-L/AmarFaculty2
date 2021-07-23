@extends('layouts.app')

@section('title')
Edit {{ $university->name }} - 
@endsection

@section('content')

  <h1>Edit {{ $university->name }}</h1>
  <form method="post" action="{{ route('universities.update', $university->id) }}">
                              {{ csrf_field() }}
      <div class="form-group">
          <label for="university-name">Name:<span class="required">*</span></label>
          <input      placeholder="Enter name"
                      id="university-name"
                      required
                      name="name"
                      spellcheck="false"
                      class="form-control"
                      value="{{ $university->name }}"
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
                      value="{{ $university->abbr }}"
                        />
      </div>

      <input type="hidden" name="_method" value="put">

      <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Submit"/>
      </div>
  </form>
  

@endsection

