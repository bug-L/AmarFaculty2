<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
     //  7. fillable options for university
     protected $fillable = [
        'name',
        'abbr',
    ];
    
    //  8. Define relationships between professor, reviews and university
    public function professors() {
        return $this->hasMany('App\Professor');
    }

    public function departments() {
        return $this->belongsToMany('App\Department');
    }

}
