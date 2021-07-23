@extends('layouts.app')

@section('links')

@endsection

@section('title', 'Approve Reviews - ')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           
            @if($reviews->count() > 0)
            <form method="post" action="{{ route('massUpdateReviews') }}" onsubmit="return confirm('You Sure?');">
                {{ csrf_field() }}
                <table style="border: 1px solid black;">
                    <tr>
                        <th style="border: 1px solid black; padding: 5px;">ID</th>
                        <th style="border: 1px solid black; padding: 5px;">Appr</th>
                        <th style="border: 1px solid black; padding: 5px;">Off</th>
                        <th style="border: 1px solid black; padding: 5px;">Del</th>
                        <th style="border: 1px solid black; padding: 5px;">Details</th>
                    </tr>    
                    {{-- UNAPPROVED REVIEWS --}}
                    @foreach($reviews as $review)
                    <tr style="border: 1px">
                        <td style="border: 1px solid black; padding: 5px;"><a href="/reviews/{{ $review->id }}">{{ $review->id }}</a></td>
                        <td style="border: 1px solid black; padding: 5px;">
                            <label>
                                <input type="radio" name="review-update[{{ $index }}]" value="approve" checked>
                                <span></span>
                            </label>
                        </td>
                        <td style="border: 1px solid black; padding: 5px;">
                            <label>
                                <input type="checkbox" name="offensive[{{ $index }}]" value="1">
                                <span></span>
                            </label>
                        </td>
                        <td style="border: 1px solid black; padding: 5px;">
                            <label>
                                <input type="radio" name="review-update[{{ $index++ }}]" value="delete">
                                <span></span>
                            </label>
                            </td>
                        <td style="border: 1px solid black; padding: 5px;">
                            {{ $review->created_at }}<br>
                            <a href="/professors/{{ $review->professor->id }}">{{ $review->professor->name }}</a><br>
                            {{ $review->professor->university->abbr }}<br>
                            <small>
                                <b>Course Code:</b> {{ $review->course_code }}<br>
                                <b>Description:</b> {{ $review->description }}<br>
                                <b>R:</b> {{ $review->rating }} <b>A:</b> {{ $review->attendance }} <b>T:</b> {{ $review->take_again }}<br>
                            </small>
                            <i>{{ $review->user_ip }}</i>
                        </td>
                    </tr>
                    <input type="hidden" name="review-id[]" value="{{ $review->id }}">
                    @endforeach
                </table>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            {{$reviews->links()}}
            @else
            <b>Nothing new to show.</b>
            @endif

        </div>
    </div>
</div>
@endsection