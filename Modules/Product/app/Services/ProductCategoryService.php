<?php

namespace Modules\Product\app\Services;


use Modules\Language\app\Enums\TranslationModels;
use Modules\Language\app\Traits\GenerateTranslationTrait;
use Modules\Product\app\Models\Category;

class ProductCategoryService
{
    use GenerateTranslationTrait;

    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    // Get all product categories

    public function getAllProductCategories()
    {
        return Category::paginate(20);
    }

    // store product category

    public function storeProductCategory($request)
    {
        $category = Category::create($request->all());
        $this->generateTranslations(
            TranslationModels::ProductCategory,
            $category,
            'product_category_id',
            $request,
        );
        return $category;
    }

    // update product category

    public function updateProductCategory($request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        $request['code'] = getSessionLanguage();
        $this->updateTranslations(
            $category,
            $request,
            $request->all(),
        );

        return $category;
    }

    // delete product category

    public function deleteProductCategory($id)
    {
        // check if category has products
        $category = Category::find($id);
        if ($category->products->count() > 0) {
            return false;
        }
        return Category::destroy($id);
    }

    // get all product categories for select

    public function getAllProductCategoriesForSelect()
    {
        return Category::where('status', '1')->get();
    }

    // get categories id by product id
    public function getCategoriesIdsByProductId($product_id)
    {
        return Category::whereHas('products', function ($query) use ($product_id) {
            $query->where('product_id', $product_id);
        })->pluck('id')->toArray();
    }

    public function getProductCategory($id)
    {
        return Category::find($id);
    }
}
