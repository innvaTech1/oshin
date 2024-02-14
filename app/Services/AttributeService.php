<?php

namespace App\Services;

use App\Repositories\AttributeRepository;

class AttributeService
{
    protected $attributeRepository;

    public function __construct(AttributeRepository $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }
    public function getActiveAll()
    {
        return $this->attributeRepository->getActiveAll();
    }
    public function getActiveAllWithoutColor()
    {
        return $this->attributeRepository->getActiveAllWithoutColor();
    }
    public function getColorAttr()
    {
        return $this->attributeRepository->getColorAttr();
    }
    public function save($data)
    {
        return $this->attributeRepository->create($data);
    }
    public function update($data, $id)
    {
        return $this->attributeRepository->update($data, $id);
    }
    public function getAll()
    {
        return $this->attributeRepository->getAll();
    }
    public function deleteById($id)
    {
        return $this->attributeRepository->delete($id);
    }
    public function findById($id)
    {
        return $this->attributeRepository->find($id);
    }

}
