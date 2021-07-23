@extends('layouts.app')

@section('title', 'Reviews - ')

@section('content')

    <div class="container">
        @if($reviews->count() > 0)

        <h2>All reviews:</h2>
        <p>
            Total Reviews = {{ $review_count }} <br>
            Unique IP = {{ $unique_count }} <br>
            Score of 5 = {{ $five_count }} <br>
            <div class="progress blue lighten-3">
                <div class="determinate blue darken-3" style="width: {{ $five_count/$review_count * 100 }}%"></div>
            </div>
            Score of 4 = {{ $four_count }} <br>
            <div class="progress blue lighten-3">
                <div class="determinate blue darken-3" style="width: {{ $four_count/$review_count * 100 }}%"></div>
            </div>
            Score of 3 = {{ $three_count }} <br>
            <div class="progress blue lighten-3">
                <div class="determinate blue darken-3" style="width: {{ $three_count/$review_count * 100 }}%"></div>
            </div>
            Score of 2 = {{ $two_count }} <br>
            <div class="progress blue lighten-3">
                <div class="determinate blue darken-3" style="width: {{ $two_count/$review_count * 100 }}%"></div>
            </div>
            Score of 1 = {{ $one_count }} <br>
            <div class="progress blue lighten-3">
                <div class="determinate blue darken-3" style="width: {{ $one_count/$review_count * 100 }}%"></div>
            </div>
        </p>
        <table style="border: 1px solid black;">
            <tr>
                <th style="border: 1px solid black; padding: 5px;">Review ID</th>
                <th style="border: 1px solid black; padding: 5px;">Professor ID</th>
                <th style="border: 1px solid black; padding: 5px;">Course Code</th>
                <th style="border: 1px solid black; padding: 5px;">Rating</th>
                <th style="border: 1px solid black; padding: 5px;">Approved</th>
            </tr>    
            @foreach($reviews as $review)
            <tr>
                <td style="border: 1px solid black; padding: 5px;"><a href="/reviews/{{ $review->id }}">{{ $review->id }}</td>
                <td style="border: 1px solid black; padding: 5px;"><a href="/professors/{{ $review->professor_id }}">{{ $review->professor_id }}</a></td>
                <td style="border: 1px solid black; padding: 5px;">{{ $review->course_code }}</td>
                <td style="border: 1px solid black; padding: 5px;">{{ $review->rating }}</td>
                <td style="border: 1px solid black; padding: 5px;">{{ $review->approved }}</td>
            </tr>
            @endforeach
        </table>
        {{ $reviews->links() }}
        @else
            <b>NO Reviews ON SYSTEM!</b>
        @endif

    </div>

@endsection