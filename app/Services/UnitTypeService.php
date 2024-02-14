<?php

namespace App\Services;

use App\Repositories\UnitTypeRepository;

class UnitTypeService
{
    protected $unitTypeRepository;

    public function __construct(UnitTypeRepository $unitTypeRepository)
    {
        $this->unitTypeRepository = $unitTypeRepository;
    }

    public function getAll()
    {
        return $this->unitTypeRepository->getAll();
    }

    public function getActiveAll()
    {
        return $this->unitTypeRepository->getActiveAll();
    }

    public function save($data)
    {
        return $this->unitTypeRepository->create($data);
    }

    public function update($data, $id)
    {
        return $this->unitTypeRepository->update($data, $id);
    }

    public function findById($id)
    {
        return $this->unitTypeRepository->find($id);
    }

    public function delete($id)
    {
        return $this->unitTypeRepository->delete($id);
    }

    public function csvDownloadUnit()
    {
        return $this->unitTypeRepository->csvDownloadUnit();
    }
}
