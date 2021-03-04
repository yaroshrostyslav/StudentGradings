<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';
    public $timestamps = false;

    protected $visible = [
        'name'
    ];

    public function student(){
        return $this->hasOne(Student::class);
    }
}
