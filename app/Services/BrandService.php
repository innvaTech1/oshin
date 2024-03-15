<?php

namespace App\Services;

use App\Repositories\BrandRepository;

class BrandService
{

    protected $brandRepository;
    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }
    public function getAll()
    {
        return $this->brandRepository->getAll();
    }

    public function save($data)
    {
        return $this->brandRepository->create($data);
    }
    public function update($data, $id)
    {
        return $this->brandRepository->update($data, $id);
    }
    public function delete($id)
    {
        return $this->brandRepository->delete($id);
    }
    public function getActiveAll()
    {
        return $this->brandRepository->getActiveAll();
    }
    public function findById($data)
    {
        return $this->brandRepository->find($data);
    }
}
