<?php

namespace App\Services\Repositories;

use App\Services\Repositories\BaseRepository;

use App\Models\Region;

class RegionRepository extends BaseRepository
{
    public function __construct(Region $region)
    {
        $this->entity = $region;
    }
}