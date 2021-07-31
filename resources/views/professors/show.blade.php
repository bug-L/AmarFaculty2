@extends('layouts.app')

@section('title')
{{ $professor->name}} - 
@endsection


@section('links')

<meta name="description" content="Read and post reviews for {{ $professor->name }}, {{ $professor->department->name }}, {{ $professor->university->name }}."/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>

{{-- Facebook share button --}}
<meta property="og:url"           content="http://www.amarguru.com/professors/{{ $professor->id }}" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="{{ $professor->name }} | {{ $professor->university->name }} | {{ $professor->department->name }}" />
<meta property="og:description"   content="Read and post reviews for {{ $professor->name }}, {{ $professor->department->name }}, {{ $professor->university->name }}." />
<meta property="og:image"         content="http://www.amarguru.com/img/envelope.png" />
@endsection


@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.collapsible');
    var instances = M.Collapsible.init(elems, {});
  });
</script>

<script>
var coll = document.getElementsByClassName("offensive");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}

</script>
@endsection


@section('styles')
<style>

.review-summary {
  border-bottom: 0px !important;
  padding-bottom: 0px !important;
}

.review-description {
    padding-top: 0px !important;
}

    </style>
@endsection

@section('content')

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
    <div class="alert-success">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
      {{ Session::get('alert-' . $msg) }}
    </div>
{{--<p class="alert alert-{{ $msg }}"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>--}}        
    @endif
    @endforeach

    @include('partials.searchbar')

    @include('partials.profile')

    @include('partials.reviews')

@endsection