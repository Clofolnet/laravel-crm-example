<?php

namespace App\Services\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Services\Repositories\BaseRepository;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    public function store($data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->entity::create($data);
    }

    public function update($data, $id)
    {
        $object = $this->entity::findOrFail($id);
        if ($object == null) {
            return $object;
        }
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $object->fill($data);
        $object->save();
        return $object->refresh();
    }
}