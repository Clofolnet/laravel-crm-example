<?php

namespace App\Services\Repositories;

use App\Services\Repositories\BaseRepository;

use App\Models\Major;

class MajorRepository extends BaseRepository
{
    public function __construct(Major $major)
    {
        $this->entity = $major;
    }
}