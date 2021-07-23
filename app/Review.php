<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//42. import SoftDeletes for deleted_at timestamps on reviews table
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    //42. continued 
    use SoftDeletes;

    //  5. fillable options for reviews
    protected $fillable = [
        'course_code',
        'rating',
        'take_again',
        'attendance',
        'description',
        'approved',
        'professor_id',
        'offensive',    //115. added offensive
        'user_ip',           //118. added IP
    ];
    
    //  6. Define relationships between professor, reviews and university
    public function professor() {
        return $this->belongsTo('App\Professor');     //could be amarGuru\Review
    }

}
