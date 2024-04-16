<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

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

    public function allActiveProducts()
    {
        return $this->productRepository->allActiveProducts();
    }
    public function findBySlug($slug)
    {
        return $this->productRepository->findBySlug($slug);
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
    public function create(Request $request)
    {
        $data = $request->all();
        return $this->productRepository->create($data);
    }
}
