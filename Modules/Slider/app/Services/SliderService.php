<?php

namespace Modules\Slider\app\Services;

use Modules\Slider\app\Models\Slider;

class SliderService
{
    protected $slider;
    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function all()
    {
        return $this->slider;
    }

    
    public function active()
    {
        return $this->all()->where('status', 1)->orderBy('order', 'asc')->get();
    }

    public function create($data)
    {
        return $this->slider->create($data);
    }

    public function find($id)
    {
        return $this->slider->find($id);
    }

    public function update($slider, $data)
    {
        return $slider->update($data);
    }

    public function delete($product)
    {
        return $product->delete();
    }
}