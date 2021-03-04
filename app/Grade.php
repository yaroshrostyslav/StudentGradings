<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grade_student';

    protected $fillable = [
        'student_id', 'subject_id', 'grade'
    ];

}
