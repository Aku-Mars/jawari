<?php

namespace App\Repositories\Eloquent;

use App\Models\Kesenian;
use App\Repositories\Interfaces\KesenianRepositoryInterface;

class KesenianRepository implements KesenianRepositoryInterface
{
    public function all()
    {
        return Kesenian::all();
    }

    public function findById($id)
    {
        return Kesenian::findOrFail($id);
    }

    public function create(array $data)
    {
        return Kesenian::create($data);
    }

    public function update($id, array $data)
    {
        $kesenian = $this->findById($id);
        $kesenian->update($data);
        return $kesenian;
    }

    public function delete($id)
    {
        $kesenian = $this->findById($id);
        return $kesenian->delete();
    }
}
