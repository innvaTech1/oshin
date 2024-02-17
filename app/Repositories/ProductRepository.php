<?php

namespace App\Repositories;

use App\Models\CategoryProduct;
use App\Models\DigitalFile;
use App\Models\Product;
use App\Models\ProductGalaryImage;
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
            return Product::with('brand')->where('is_approved', 1)->latest();
        } else {
            return Product::with('brand')->where('created_by', $user->id)->latest();
        }
    }
    public function getProduct()
    {
        $all_columns = Schema::getColumnListing('products');
        $exclude_columns = ['description', 'specification'];
        $get_columns = array_diff($all_columns, $exclude_columns);
        return Product::with(['brand', 'unit_type'])->select($get_columns)->where('is_approved', 1);
    }
    public function getByAjax($search)
    {
        $products = collect();
        if ($search != '') {
            $products = Product::where('is_approved', 1)->where('status', 1)->where('product_name', 'LIKE', "%{$search}%")->paginate(10);
        } else {
            $products = Product::where('is_approved', 1)->where('status', 1)->paginate(10);
        }
        $response = [];
        foreach ($products as $product) {
            $response[] = [
                'id' => $product->id,
                'text' => $product->product_name,
            ];
        }
        return $response;
    }

    public function getAllSKU()
    {
        return ProductSku::with(['product' => function ($q) {
            $q->select('id', 'product_name', 'thumbnail_image_source', 'brand_id', 'subtitle_1', 'subtitle_2');
        }, 'product.brand' => function ($q2) {
            $q2->select('id', 'name');
        }]);
    }
    public function create(array $data)
    {
        $host = activeFileStorage();
        $product = new Product();
        $user = auth('admin')->user()->roles[0]->name;

        if ($user == 'Super Admin' || $user == 'Admin' || $user == 'Staff') {
            $data['is_approved'] = 1;
            $data['requested_by'] = $user->role_id;
        } else {
            $data['is_approved'] = 0;
            $data['requested_by'] = $user->role_id;
        }
        if ($data['is_physical'] == 0) {
            $data['is_physical'] = 0;
            $data['shipping_type'] = 1;
            $data['shipping_cost'] = 0;
            $digital_product = new DigitalFile();
        }

        if ($data['max_order_qty'] != null && $data['max_order_qty'] < 1) {
            $data['max_order_qty'] = null;
        }

        if (isset($data['gst_group'])) {
            $data['gst_group_id'] = $data['gst_group'];
        }

        $data['slug'] = productSlug($data['product_name']);

        $product->fill($data)->save();

        // send notification from seller request
        // if ($data['request_from'] == 'seller_product_form') {
        //     $notificationUrl = route('seller.product.index');
        //     $notificationUrl = str_replace(url('/'), '', $notificationUrl);
        //     $this->notificationUrl = $notificationUrl;
        //     $this->adminNotificationUrl = '/products';
        //     $this->routeCheck = 'product.index';
        //     $this->typeId = EmailTemplateType::where('type', 'product_approve_email_template')->first()->id;
        //     $notification = NotificationSetting::where('slug', 'seller-product-create')->first();
        //     if ($notification) {
        //         $this->notificationSend($notification->id, $product->created_by);
        //     }
        // }
        $tags = [];
        $tags = explode(',', $data['tags']);
        foreach ($tags as $key => $tag) {
            $tag = Tag::where('name', $tag)->updateOrCreate([
                'name' => strtolower($tag),
            ]);
            ProductTag::create([
                'product_id' => $product->id,
                'tag_id' => $tag->id,
            ]);
        }
        if (isset($data['category_ids'])) {
            foreach ($data['category_ids'] as $category) {
                CategoryProduct::create([
                    'category_id' => $category,
                    'product_id' => $product->id,
                ]);
            }
        }
        if (count($data['galary_image']) > 0) {
            $media_ids = explode(',', $data['media_ids']);
            foreach ($data['galary_image'] as $i => $image) {
                $product_galary_image = new ProductGalaryImage();
                $product_galary_image->product_id = $product->id;
                $product_galary_image->images_source = $image;
                // $product_galary_image->media_id = $media_ids[$i];
                $product_galary_image->save();
            }
        }
        if ($data['product_type'] == 1) {
            $product_sku = new ProductSku;
            $product_sku->product_id = $product->id;
            $product_sku->sku = $data['product_sku'];
            $product_sku->weight = isset($data['weight']) ? $data['weight'] : 0;
            $product_sku->length = isset($data['length']) ? $data['length'] : 0;
            $product_sku->breadth = isset($data['breadth']) ? $data['breadth'] : 0;
            $product_sku->height = isset($data['height']) ? $data['height'] : 0;
            $product_sku->selling_price = $data['selling_price'];
            $stock = 0;
            if ($data['stock_manage'] == 1) {
                $stock = $data['single_stock'];
            }

            $product_sku->additional_shipping = $data['additional_shipping'];
            $product_sku->status = ($user == 'Super Admin' || $user == 'Admin' || $user == 'Staff') ? $data['status'] : 0;
            $product_sku->product_stock = $stock;
            $product_sku->save();
            if ($data['is_physical'] == 0 && isset($data['file_source'])) {
                $digital_product->create([
                    'product_sku_id' => $product_sku->id,
                    'file_source' => $data['file_source'],
                ]);
            }
        }
        if ($data['product_type'] == 2) {
            foreach ($data['track_sku'] as $key => $variant_sku) {
                $product_sku = new ProductSku;
                $product_sku->product_id = $product->id;
                $product_sku->sku = $data['sku'][$key];
                $product_sku->weight = isset($data['weight']) ? $data['weight'] : 0;
                $product_sku->length = isset($data['length']) ? $data['length'] : 0;
                $product_sku->breadth = isset($data['breadth']) ? $data['breadth'] : 0;
                $product_sku->height = isset($data['height']) ? $data['height'] : 0;
                $product_sku->track_sku = $data['track_sku'][$key];
                $product_sku->selling_price = $data['selling_price_sku'][$key];
                $product_sku->additional_shipping = $data['additional_shipping'];
                $image_increment = $key + 1;
                $media_img = null;
                if (isset($data['variant_image_' . $image_increment])) {
                    $media_img = MediaManager::find($data['variant_image_' . $image_increment]);
                    if ($media_img) {
                        if ($media_img->storage == 'local') {
                            $file = asset_path($media_img->file_name);
                        } else {
                            $file = $media_img->file_name;
                        }
                        $variant_image = ImageStore::saveImage($file, 600, 545);
                        if ($host == 'Dropbox') {
                            $product_sku->variant_image = $variant_image['images_source'];
                            $product_sku->file_dropbox = $variant_image['file_dropbox'];
                        } else {
                            $product_sku->variant_image = $variant_image;
                        }
                    }
                } else {
                    $product_sku->variant_image = null;
                }
                $product_sku->status = ($user->role->type == 'admin' || $user->role->type == 'superadmin' || $user->role->type == 'staff') ? $data['status'] : 0;
                $stock = 0;
                if (!isModuleActive('MultiVendor')) {
                    if ($data['stock_manage'] == 1) {
                        $stock = $data['sku_stock'][$key];
                    }
                }
                $product_sku->product_stock = $stock;
                $product_sku->save();
                if (isset($data['variant_image_' . $image_increment])) {
                    UsedMedia::create([
                        'media_id' => $media_img->id,
                        'usable_id' => $product_sku->id,
                        'usable_type' => get_class($product_sku),
                        'used_for' => 'variant_image',
                    ]);
                }
                if ($data['is_physical'] == 0 && @$data['file_source'][$key]) {
                    $digital_product->create([
                        'product_sku_id' => $product_sku->id,
                        'file_source' => $data['file_source'][$key],
                    ]);
                }
                $attribute_id = explode('-', $data['str_attribute_id'][0]);
                $attribute_value_id = explode('-', $data['str_id'][$key]);
                foreach ($attribute_value_id as $k => $value) {
                    $product_variation = new ProductVariations;
                    $product_variation->product_id = $product->id;
                    $product_variation->product_sku_id = $product_sku->id;
                    $product_variation->attribute_id = $attribute_id[$k];
                    $product_variation->attribute_value_id = $attribute_value_id[$k];
                    $product_variation->save();
                }
            }
        }
        if (isset($data['related_product_hidden_name'])) {
            $related_product = json_decode($data['related_product_hidden_name']);
            foreach ($related_product as $key => $item) {
                ProductRelatedSale::create([
                    'product_id' => $product->id,
                    'related_sale_product_id' => $item,
                ]);
            }
        }
        if (isset($data['upsale_product_hidden_name'])) {
            $up_sale = json_decode($data['upsale_product_hidden_name']);
            foreach ($up_sale as $key => $item) {
                ProductUpSale::create([
                    'product_id' => $product->id,
                    'up_sale_product_id' => $item,
                ]);
            }
        }
        if (isset($data['crosssale_product_hidden_name'])) {
            $cross_sale = json_decode($data['crosssale_product_hidden_name']);
            foreach ($cross_sale as $key => $item) {
                ProductCrossSale::create([
                    'product_id' => $product->id,
                    'cross_sale_product_id' => $item,
                ]);
            }
        }
        if (auth()->user()->role->type == 'superadmin' || auth()->user()->role->type == 'admin' || auth()->user()->role->type == 'staff') {
            $status = 0;
            if (isset($data['save_type'])) {
                if ($data['save_type'] == 'save_publish') {
                    $status = 1;
                }
            }

            if (isModuleActive('FrontendMultiLang')) {
                $sellerProductName = $this->productSlug($data['product_name'][auth()->user()->lang_code]);
            } else {
                $sellerProductName = $this->productSlug($product->product_name);
            }
            $sellerProduct = new SellerProduct();
            $sellerProduct->product_id = $product->id;
            $sellerProduct->product_name = $data['product_name'];
            $sellerProduct->stock_manage = (!isModuleActive('MultiVendor') && isset($data['stock_manage'])) ? $data['stock_manage'] : 0;
            $sellerProduct->tax = $product->tax ?? 0;
            $sellerProduct->tax_type = $product->tax_type;
            $sellerProduct->discount = $product->discount;
            $sellerProduct->discount_type = $product->discount_type;
            $sellerProduct->user_id = 1;
            $sellerProduct->slug = $sellerProductName;
            $sellerProduct->is_approved = 1;
            $sellerProduct->status = isModuleActive('MultiVendor') ? $status : $data['status'];
            $sellerProduct->subtitle_1 = $data['subtitle_1'];
            $sellerProduct->subtitle_2 = $data['subtitle_2'];
            $sellerProduct->save();
            $product_skus = ProductSku::where('product_id', $product->id)->get();
            foreach ($product_skus as $key => $item) {
                $sellerProductSKU = SellerProductSKU::create([
                    'product_id' => $sellerProduct->id,
                    'product_sku_id' => $item->id,
                    'product_stock' => $item->product_stock,
                    'selling_price' => $item->selling_price,
                    'status' => 1,
                    'user_id' => 1,
                ]);
                $sellerProduct->update([
                    'min_sell_price' => $sellerProduct->skus->min('selling_price'),
                    'max_sell_price' => $sellerProduct->skus->max('selling_price'),
                ]);
                //add Whole-sale price
                if (isModuleActive('WholeSale') && isset($data['wholesale_min_qty_' . $key])) {
                    $wholeSaleMinQty = $data['wholesale_min_qty_' . $key];
                    $wholeSaleMaxQty = $data['wholesale_max_qty_' . $key];
                    $wholeSalePrice = $data['wholesale_price_' . $key];
                    $wholeSaleArrValue = [];
                    if ($wholeSaleMinQty[0] != null) {
                        foreach ($wholeSaleMinQty as $keyMinQty => $minVal) {
                            $wholeSaleArrValue['min_qty'] = $wholeSaleMinQty[$keyMinQty];
                            $wholeSaleArrValue['max_qty'] = $wholeSaleMaxQty[$keyMinQty];
                            $wholeSaleArrValue['selling_price'] = $wholeSalePrice[$keyMinQty];
                            $wholeSaleArrValue['product_id'] = $sellerProduct->id;
                            $wholeSaleArrValue['sku_id'] = $sellerProductSKU->id;
                            $wholeSaleArrValue['created_at'] = date('Y-m-d');
                            $wholeSaleArrValue['updated_at'] = date('Y-m-d');
                            WholesalePrice::insert($wholeSaleArrValue);
                        }
                    }
                }
            }
        }
        return true;
    }

}
