
@isset($avg)
<br>
<h6 class="grey-text text-darken-2">Reviews for {{ $professor->name }}:</h6><br>

<ul class="collection">

    @foreach($paginated_reviews as $review)
        
    <li class="review-summary collection-item avatar">
        
        <img style="margin-top: 20px" src="{{ asset('img/rating_' . $review->rating . '.png') }}" class="circle animated pulse infinite" alt="Emoji">
                
        <div class="row">
            <div class="col sm-5">
                <p class="review-options">
                    <strong>Course Code:</strong><br>
                    <strong>Rating:</strong><br>
                    <strong>Attendance was </strong><br>
                    <strong>Recommend taking?</strong>
                </p>
            </div>
            <div class="col sm-7">
                <p class="review-options">
                    <span><strong>{{ $review->course_code }}</strong></span>

                    <br> 
                    
                    @if($review->rating == 1)
                    <span><strong>1 out of 5</strong></span>
                    @elseif($review->rating == 2)
                    <span><strong>2 out of 5</strong></span>
                    @elseif($review->rating == 3)
                    <span><strong>3 out of 5</strong></span>
                    @elseif($review->rating == 4)
                    <span><strong>4 out of 5</strong></span>
                    @else
                    <span><strong>5 out of 5</strong></span>
                    @endif

                    <br>

                    @if($review->attendance == 1)
                    <span><strong>Important</strong></span>
                    @else 
                    <span><strong>Not Important</strong></span>
                    @endif

                    <br>

                    @if($review->take_again == 1)
                    <span><strong>Yes</strong></span>
                    @else 
                    <span><strong>No</strong></span>
                    @endif
                </p>
                <a href="#!" class="secondary-content"><i class="material-icons blue-text text-darken-2 small" style="margin-top: 20px;">grade</i></a>
                
            </div>
        </div>
        
        
    </li>
    
    <li class="review-description collection-item">
        @isset($review->description)
            @if($review->offensive == '1')
            <a class="offensive"><i><b>!</b><small> This comment may be offensive/inappropriate. Click to unhide.</small></i></a>
            <div class="offensive-content">
                <p>{{ $review->description }}</p>
            </div>
           
            @else
    
            {{ $review->description }}
            @endif
        
        @endisset
        <p class="review-options"><i>posted on {{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y')}}</i></p>
    </li>

    @auth
    <li class="collection-item">
        <form action="{{ route('reviews.destroy', $review->id) }}" method="post" onsubmit="return confirm('You Sure?');">
            {{ csrf_field() }}
            <a href="/reviews/{{ $review->id }}" class="btn btn-small">View</a>
            <a href="/reviews/{{ $review->id }}/edit" class="btn btn-small">Edit</a>
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-small red" type="submit">Del</button>
            <small><i>{{ $review->user_ip }}</i></small>
        </form>
    </li>
    @endauth 
    

@endforeach

</ul>
<div class="center-align">
    {{ $paginated_reviews->links() }}
</div>
@else
<br>
<p class="grey-text text-darken-2">No reviews yet for {{ $professor->name }}.<a href="/professors/{{ $professor->id }}/review"> Click here to post a review.</a></p>

@endisset
