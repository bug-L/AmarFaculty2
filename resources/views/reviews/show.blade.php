@extends('layouts.app')

@section('title')
Review ID: {{ $review->id }} - 
@endsection

@section('content')

<div class="container">

    <div class="jumbotron">
        <b>Review ID:</b> {{ $review->id }}<br>
        <b>Posted on: </b> {{ $review->created_at }}<br>
        {{-- $professor->first() means 0th professor from array --}}
        <b>Professor:</b> <a href="/professors/{{ $professor->first()->id }}">{{ $professor->first()->name }}</a><br>
        <b>Course Code:</b> {{ $review->course_code }}<br>
        <b>Rating:</b> {{ $review->rating }} out of 5<br> 
    
    @if($review->take_again == 0)
        <b>Take again:</b> No<br>
    @else
        <b>Take again:</b> Yes<br>
    @endif
    
    @if($review->attendance == 0)
        <b>Attendance was</b> optional<br>
    @else
        <b>Attendance was</b> mandatory<br><br>
    @endif
    
        <b>Description:</b><br>
        <i>{{ $review->description }}</i><br><br>

        <b>IP:</b><br>
        <i>{{ $review->user_ip }}</i><br>
    
    @if($review->offensive == 1)
        <p class="red-text">This review is offensive.</p>
    @endif

    @if($review->approved == 0)
        <small><i>This review has not been approved yet.</i></small>
    @else
        <small><i>This review was approved on {{ $review->updated_at }}</i></small>
    @endif
    </div><br>

    <form action="{{ route('reviews.destroy', $review->id) }}" method="post" onsubmit="return confirm('You Sure?');">
        {{ csrf_field() }}
        
        <input name="_method" type="hidden" value="DELETE">
        <a href="/reviews/{{ $review->id }}/edit" class="btn">Edit</a>
        <button class="btn red" type="submit">Delete</button>
    </form>

</div>

@endsection