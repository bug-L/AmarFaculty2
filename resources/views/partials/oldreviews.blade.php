
<div class="card reviews">
    <div class="card-header">
        <h5 class="card-title mt-2 underline text-dark">All reviews for {{ $professor->name }}:</h5>
    </div>

@isset($avg)
    @foreach($paginated_reviews as $review)

    
    
    <div class="card-body">
        <p class="text-left"><u>{{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y')}}</u></p>    
        
        <div class="row justify-content-between">
        
            <div class="col-5 text-primary text-center">
                
                    
            <p><label><b>Rating:</b></label></p>
            <p><label><b>Take Again?</b></label></p>
            <p><label><b>Attendance:</b></label></p>
            <p><label><b>Course Code:</b></label></p>

            </div>
            <div class="col-4">
                
                <p class="text-left">
                
                    @if($review->rating == 1)
                    <label class="badge badge-danger mt-1"><b>1 out of 5</b></label>
                    @elseif($review->rating == 2)
                    <label class="badge badge-warning mt-1"><b>2 out of 5</b></label>
                    @elseif($review->rating == 3)
                    <label class="badge badge-info mt-1"><b>3 out of 5</b></label>
                    @elseif($review->rating == 4)
                    <label class="badge badge-primary mt-1"><b>4 out of 5</b></label>
                    @else
                    <label class="badge badge-success mt-1"><b>5 out of 5</b></label>
                    @endif
                    

                </p>

                <p class="text-left">
                @if($review->take_again == 1)
                    <label class="badge badge-success"> YES </label>
                @else 
                    <label class="badge badge-danger"> NO </label>
                @endif
                </p>

                <p class="text-left mt-3">
                @if($review->attendance == 1)
                    <label class="badge badge-primary"> MANDATORY </label>
                @else 
                    <label class="badge badge-success"> OPTIONAL </label>
                @endif
                </p>

                <p class="text-left mt-4">
                    <label class="badge badge-light"> {{ $review->course_code }} </label>
                </p>
                
            </div>
            <div class="col-2">
            @auth
                <a href="/reviews/{{ $review->id }}" class="btn btn-sm btn-primary">View</a>
                <a href="/reviews/{{ $review->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('reviews.destroy', $review->id) }}" method="post" onsubmit="return confirm('You Sure?');">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-sm btn-danger" type="submit">Del</button>
                </form>
                        
            @endauth 
                    @if($review->rating == 1)
                    <img src="{{ asset('img/rating_1.png') }}" style="height: 60px;" class="float-right"><br>
                    @elseif($review->rating == 2)
                    <img src="{{ asset('img/rating_2.png') }}" style="height: 60px;" class="float-right">
                    @elseif($review->rating == 3)
                    <img src="{{ asset('img/rating_3.png') }}" style="height: 60px;" class="float-right">
                    @elseif($review->rating == 4)
                    <img src="{{ asset('img/rating_4.png') }}" style="height: 60px;" class="float-right">
                    @else
                    <img src="{{ asset('img/rating_5.png') }}" style="height: 60px;" class="float-right">
                    @endif
                    
                   
            </div>
            
        </div>
        <div class="card card-body">
        @isset($review->description)
            <p>
            <span class="text-primary">Description:</span><br>
            @if($review->offensive == '1')
            <small>
                <div class="collapse" id="collapseExample">
                {{ $review->description }}<br>
                
                </div>
                <a class="text-danger" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <i>This comment might be offensive or inappropriate.</i>
                </a>
            </small>
            @else
            <small>{{ $review->description }}</small>
            @endif
            </p>
        
        @else
        
            <p>
            <span class="text-info"><i>No description provided.</i></span>
            </p>
        
        @endisset
        </div>
    </div>

    <hr>
    <hr>
    @endforeach
    <div class="card-footer">
        {{ $paginated_reviews->links() }}
    </div>


@else
    <div class="card-body">
        <div class="row justify-content-center">        
            <div class="col-6 text-primary text-right">                
                <p class="text-secondary ml-1 mr-1">No reviews posted.<a href="/professors/{{ $professor->id }}/review"> Be the first one to post a review!</a></p>                            
            </div>
            <div class="col-2">                          
                    <img src="{{ asset('img/thinking.png') }}" style="height: 60px;" class="float-left"><br>
            </div>            
        </div>       
    </div>
@endisset
</div>
