<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentUniversity extends Model
{
    //protected $table = 'department_unviersity';
    //13. set fillable fields for model
    protected $fillable = [
        'department_id',
        'university_id',
    ];
}
