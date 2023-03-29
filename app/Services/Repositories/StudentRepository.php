<?php

namespace App\Services\Repositories;

use App\Services\Repositories\BaseRepository;

use App\Models\Student;

class StudentRepository extends BaseRepository
{
    public function __construct(Student $student)
    {
        $this->entity = $student;
    }
}