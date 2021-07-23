<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //9. fillable option for department set
    protected $fillable = [
        'name',
    ];

    //10. Department relationships set
    public function professors() {
        return $this->hasMany('App\Professor');
    }

    public function universities() {

        return $this->belongsToMany('App\University');
    
    }
}
