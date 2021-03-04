<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeController extends ApiController
{
    public function get($id, Request $request){
        $student = Student::with('teacher')->with('grades')->where('id', '=', $id);

        return $this->sendResponse($student->get()->toArray(), 'Successfully.');
    }

    public function add($id, Request $request){
        $data = $request->all();
        $data['student_id'] = $id;

        $validator = Validator::make($data, [
            'student_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'grade' => 'required|integer',
        ]);

        $grade = Grade::create($data);
        return $this->sendResponse($grade->toArray(), 'Grade Added Successfully.');
    }
}
