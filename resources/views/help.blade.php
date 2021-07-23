@extends('layouts.app')

@section('title', 'Help - ')

@section('styles')

@endsection

@section('content')

<div class="row">
  <div class="col s12">
  <h1 style="font-size: 150%" class="card-title center-align grey-text text-darken-2"><strong>How to use AmarGuru.com</strong></h1>
    <ul class="collapsible">
      <li>
        <div class="collapsible-header"><i class="material-icons">filter_drama</i>Find a faculty</div>
        <div class="collapsible-body">
          <h6><strong>1. Go to <a href="/" target="_blank">www.amarguru.com</a> on your web browser.</strong></h6><br>
          <div class="center-align">
            <img src="{{ asset('img/help1.PNG') }}" class="responsive-img">
          </div>
          
          <h6><strong>2. Enter the name/intials of your faculty and click on 'Find Faculty'.</strong></h6><br>
          <div class="center-align">
            <img src="{{ asset('img/help2.PNG') }}" class="responsive-img">
          </div>

          <h6><strong>3. Select your faculty from the list of results.</strong></h6><br>
          <div class="center-align">
            <img src="{{ asset('img/help3.PNG') }}" class="responsive-img">
          </div>

          <p class="red-text text-darken-2">If you don't see your faculty on the list of results, see <strong>'Add a new faculty'</strong> section below:</p>
        </div>
      </li>
      <li>
        <div class="collapsible-header"><i class="material-icons">place</i>Add a new faculty</div>
        <div class="collapsible-body">
          <h6><strong>1. On the search result page, click on 'Click here to add'.</strong></h6><br>
          <div class="center-align">
            <img src="{{ asset('img/help6.PNG') }}" class="responsive-img">
          </div>
          <h6><strong>2. Enter faculty name, initials (optional), university and department and click on 'Add New Faculty'.</strong></h6><br>
          <div class="center-align">
            <img src="{{ asset('img/help7.PNG') }}" class="responsive-img">
          </div>
          <h6><strong>3. Your faculty is added! You can now post a review. See 'Post a review' section below.</strong></h6><br>
          <div class="center-align">
            <img src="{{ asset('img/help8.PNG') }}" class="responsive-img">
          </div>
        </div>
      </li>
      <li>
        <div class="collapsible-header"><i class="material-icons">whatshot</i>Post a review</div>
        <div class="collapsible-body">
          <h6><strong>1. Go to your faculty's profile and click on 'Post A Review'.</strong></h6><br>
          <div class="center-align">
            <img src="{{ asset('img/help4.PNG') }}" class="responsive-img">
          </div>
          <h6><strong>2. Enter all the necessary information and click on 'Post Review'.</strong></h6><br>
          <div class="center-align">
            <img src="{{ asset('img/help5.PNG') }}" class="responsive-img">
          </div>
          <h6><strong>3. Your review is now posted!</strong></h6>
        </div>
        </div>
      </li>
    </ul>

    <div class="center-align">
        <a href="/" class="btn blue darken-3">Get Started</a>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function(){
    $('.collapsible').collapsible();
  });

</script>
@endsection