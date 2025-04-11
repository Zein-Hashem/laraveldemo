<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    protected $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    // Get all students with pagination
    public function index()
    {
            $students = Student::paginate(10);
            return response()->json($students);
    }

    // Get student by teacher user ID
    public function getByTeacher($teacherId)
    {
        $students = $this->studentRepository->getByTeacherId($teacherId); 
        return response()->json($students);
    }
}