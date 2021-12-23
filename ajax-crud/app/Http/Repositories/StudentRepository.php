<?php

namespace App\Http\Repositories;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentRepository
{
	protected $student;

	public function __construct(
		Student $student
	){
		$this->student = $student;
	}

	public function fetchstudent()
    {
        $students = $this->student->all();
        return response()->json([
            'students'=>$students,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required|max:191',
            'course'=>'required|max:191',
            'email'=>'required|email|max:191',
            'phone'=>'required|max:10|min:10',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
        	$this->student->create([
	            'name' => $request->input('name'),
	            'course' => $request->input('course'),
	            'email' => $request->input('email'),
	            'phone' => $request->input('phone'),
        	]);
            return response()->json([
                'status'=>200,
                'message'=>'Student Added Successfully.'
            ]);

        }

    }

    public function edit($id)
    {
        $student = $this->student->find($id);
        if($student)
        {
            return response()->json([
                'status'=>200,
                'student'=> $student,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Student Found.'
            ]);
        }

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required|max:191',
            'course'=>'required|max:191',
            'email'=>'required|email|max:191',
            'phone'=>'required|max:10|min:10',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $student = $this->student->find($id);
            if($student)
            {
            	$student->update([
                    'name' => $request->input('name'),
                    'course' => $request->input('course'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
            	]);


                return response()->json([
                    'status'=>200,
                    'message'=>'Student Updated Successfully.'
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'No Student Found.'
                ]);
            }

        }
    }

    public function destroy($id)
    {
        $student = $this->student->find($id);
        if($student)
        {
            $student->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Student Deleted Successfully.'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Student Found.'
            ]);
        }
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $student = $this->student->whereIn('id',explode(",",$ids));
        if($student)
        {
            $student->delete();
            return response()->json([
                'error'=> false,
                'message'=>'Student Deleted Successfully.'
            ]);
        }
        else
        {
            return response()->json([
                'error'=> true,
                'message'=>'No Student Found.'
            ]);
        }
    }
}