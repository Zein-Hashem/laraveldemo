<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\Interfaces\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface
{
    public function getAllWithPagination($perPage = 10)
    {
        return Student::with('teacher')->paginate($perPage);
    }

    public function getByTeacherId($teacherId)
    {
        return Student::where('teacher_id', $teacherId)->get();
    }
}