<?php

namespace App\Repositories\Interfaces;

interface StudentRepositoryInterface
{
    public function getAllWithPagination($perPage = 10);
    public function getByTeacherId($teacherId);
}