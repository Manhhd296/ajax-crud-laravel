<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\StudentService;

class StudentController extends Controller
{
    
    protected $studentService;

    public function __construct(
        StudentService $studentService
    ){
        return $this->studentService = $studentService;
    }

    public function index()
    {
        return view('student.index');
    }

    public function fetchstudent()
    {
        return $this->studentService->fetchstudent();
    }

    public function store(Request $request)
    {
        return $this->studentService->store($request);

    }

    public function edit($id)
    {
        return $this->studentService->edit($id);

    }

    public function update(Request $request, $id)
    {
        return $this->studentService->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->studentService->destroy($id);
    }

    public function deleteAll(Request $request)
    {
        return $this->studentService->deleteAll($request);
    }
}