<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Repositories\StudentRepository;

class StudentService
{
	protected $studentRepository;

	public function __construct(
		StudentRepository $studentRepository
	){
		$this->studentRepository = $studentRepository;
	}

	public function fetchstudent()
    {
        return $this->studentRepository->fetchstudent();
    }

    public function store(Request $request)
    {
        return $this->studentRepository->store($request);
    }

    public function edit($id)
    {
        return $this->studentRepository->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->studentRepository->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->studentRepository->destroy($id);
    }

    public function deleteAll(Request $request)
    {
        return $this->studentRepository->deleteAll($request);
    }
}