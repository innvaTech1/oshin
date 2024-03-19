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
        $galary_image = $data['image'];

        if ($data['is_physical'] == 0 && $data['product_type'] == 'variant') {
            if (@$data['digital_file']) {
                foreach ($data['digital_file'] as $key => $file) {
                    $data['file_source'] = file_upload($data['single_digital_file'], null, '/uploads/digital_file/');
                    $data['file_source'][$key] = '/uploads/digital_file/' . $data['file_source'];
                }
            }
        } else {
            if (@$data['single_digital_file']) {
                $data['file_source'] = file_upload($data['single_digital_file'], null, '/uploads/digital_file/');
            }
        }

        return $this->productRepository->create($data);
    }
}
