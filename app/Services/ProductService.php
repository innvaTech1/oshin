<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function all()
    {
        return $this->productRepository->getAll();
    }
    public function allbyPaginate()
    {
        return $this->productRepository->allbyPaginate();
    }
    public function getAllForEdit($id)
    {
        return $this->productRepository->getAllForEdit($id);
    }
    public function getAllSKU()
    {
        return $this->productRepository->getAllSKU();
    }
    public function create($data)
    {

        return $this->productRepository->create($data);
    }
}
