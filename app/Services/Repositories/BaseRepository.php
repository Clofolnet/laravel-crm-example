<?php
namespace App\Services\Repositories;

class BaseRepository
{
    public $entity;

    public function index()
    {
        return $this->entity::latest()->paginate(10);
    }

    public function store($data)
    {
        return $this->entity::create($data);
    }

    public function show($id)
    {
        return $this->entity::findOrFail($id);
    }

    public function update($data, $id)
    {
        $object = $this->entity::findOrFail($id);
        if ($object == null) {
            return $object;
        }
        $object->fill($data);
        $object->save();
        return $object->refresh();
    }

    public function destroy($id)
    {
        $object = $this->entity::findOrFail($id);
        if ($object == null) {
            return $object;
        }
        $modelData = $object;
        $object->delete();
        return $modelData;
    }
}