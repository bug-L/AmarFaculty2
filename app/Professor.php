<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//46. import SoftDeletes for deleted_at timestamps on reviews table
use Illuminate\Database\Eloquent\SoftDeletes;

class Professor extends Model
{
    use SoftDeletes;    //46.
    
    //  4. fillable options for professor
    protected $fillable = [
        'name',
        'university_id',
        'department_id',
        'approved',     //45. added approved to model.  
        //100. added fillable initials
        'initials',
    ];
    
    //  3. Define relationships between professor, reviews and university
    public function reviews() {
        return $this->hasMany('App\Review');
    }

    public function university() {
        return $this->belongsTo('App\University');
    }

    public function department() {
        return $this->belongsTo('App\Department');
    }

}
