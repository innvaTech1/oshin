<?php

namespace App\Repositories;

use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class ProductRepository
{
    public function getAll()
    {
        $user = $user = auth('admin')->user()->roles[0]->name;
        if ($user == 'Super Admin' || $user == 'admin' || $user == 'staff') {
            return Product::with('brand')->latest();
        } else {
            return Product::with('brand')->where('created_by', $user->id)->latest();
        }
    }
    public function getProduct()
    {
        $all_columns = Schema::getColumnListing('products');
        $exclude_columns = ['long_description', 'specification'];
        $get_columns = array_diff($all_columns, $exclude_columns);
        return Product::with(['brand', 'unit_type'])->select($get_columns)->where('is_approved', 1);
    }
    public function getByAjax($search)
    {
        $products = collect();
        if ($search != '') {
            $products = Product::where('is_approved', 1)->where('status', 1)->where('name', 'LIKE', "%{$search}%")->paginate(10);
        } else {
            $products = Product::where('is_approved', 1)->where('status', 1)->paginate(10);
        }
        $response = [];
        foreach ($products as $product) {
            $response[] = [
                'id' => $product->id,
                'text' => $product->name,
            ];
        }
        return $response;
    }

    public function getAllSKU()
    {
        return ProductSku::with(['product' => function ($q) {
            $q->select('id', 'name', 'thumbnail_image_source', 'brand_id', 'subtitle_1', 'subtitle_2');
        }, 'product.brand' => function ($q2) {
            $q2->select('id', 'name');
        }]);
    }
    public function create(array $data)
    {
        // dd($data);
        $product = Product::create([
            'product_name' => $data['name'],
            'slug' => $data['slug'],
            'user_id' => auth('admin')->user()->id,
            'brand_id' => $data['brand_id'],
            'unit_id' => $data["unit_id"],
            'sku' => $data['sku'],
            'price' => $data['price'],
            'discount' => isset($data['discount']) ? $data['discount'] : 0,
            'discount_type' => $data['discount_type'],
            'qty' => $data['quantity'],
            'video_link' => $data['video_link'],
            'short_description' => $data["short_description"],
            'description' => $data["description"],
            'additional_information' => $data["additional_information"],
            'is_return' => $data['is_returnable'],
            'is_pre_order' => $data['is_pre_order'],
            'is_partial' => $data['is_partial'],
            'partial_amount' => isset($data['partial_amount']) ? $data['partial_amount'] : 0,
            'is_warranty' => $data['is_warranty'],
            'warranty_duration' => isset($data["warranty_duration"]) ? $data["warranty_duration"] : null,
            'status' => $data['status'],
            'meta_title' => isset($data['meta_title']) ? $data['meta_title'] : null,
            'meta_description' => isset($data['meta_description']) ? $data['meta_description'] : null,
            'is_featured' => $data["is_featured"],
            'is_bestseller' => $data["is_bestseller"],
            'is_new' => $data["is_new"],
            'is_verified' => $data["is_verified"],
            'is_cod' => $data["is_cod"],
            'release_date' => isset($data["release_date"]) ? $data["release_date"] : null,
            'max_product' => isset($data["max_product"]) ? $data["max_product"] : 1,
            'badge' => $data["badge"],
            'created_by' => auth('admin')->user()->id,
        ]);
        
        $tags = [];
        if (isset($data['tags'])) {
            $tags = json_decode($data['tags']);
        }

        foreach ($tags as $key => $tag) {

            $tag = Tag::where('name', $tag->value)->updateOrCreate([
                'name' => strtolower($tag->value),
            ]);
            ProductTag::create([
                'product_id' => $product->id,
                'tag_id' => $tag->id,
            ]);
        }
        if (isset($data['categories'])) {
            foreach ($data['categories'] as $category) {
                CategoryProduct::create([
                    'category_id' => $category,
                    'product_id' => $product->id,
                ]);
            }
        }

    }
}
