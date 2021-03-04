<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends ApiController
{
    public function get(Request $request){

        $students = Student::with('teacher')->with('grades');

        if ($request->has('search')) {
            $students->where('name', 'like', "%$request->search%");
        }

        if ($request->has('class')) {
            $students->where('class', '=', $request->class);
        }

        if ($request->has('faculty')) {
            $students->where('faculty', '=', $request->faculty);
        }

        if ($request->has('teacher_id')) {
            $students->where('teacher_id', '=', $request->teacher_id);
        }

        if ($request->has('age')) {
            $students->where('age', '=', $request->age);
        }

        if ($request->has('sort_by') && $request->has('sort_order')) {
            $students->orderBy($request->sort_by, $request->sort_order);
        }

        if ($request->has('limit')) {
            $students->limit($request->limit);
        }

        return $this->sendResponse($students->get()->toArray(), 'Successfully.');

    }

    public function add(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|max:60',
            'class' => 'required|integer',
            'birthday' => 'required|date_format:Y-m-d H:i:s',
            'faculty' => 'required|max:60',
            'teacher_id' => 'required|integer',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error', $validator->errors());
        }

        $student = Student::create($data);
        return $this->sendResponse($student->toArray(), 'Student Created Successfully.');
    }

}
