<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    public $timestamps = false;

    protected $fillable = [
        'id', 'name', 'age', 'birthday', 'faculty', 'class', 'teacher_id'
    ];

    protected $visible = [
        'name', 'birthday', 'faculty', 'class', 'teacher', 'avg_grade', 'grades'
    ];

    protected $appends = ['avg_grade'];

    public function getAvgGradeAttribute(){
        return $this->attributes['avg_grade'] = $this->grades()->avg('grade');
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function grades(){
        return $this->belongsToMany(Subject::class, 'grade_student', 'student_id', 'subject_id')->withPivot('grade');
    }

    public function grade(){
        return $this->belongsToMany(Grade::class);
    }
}
