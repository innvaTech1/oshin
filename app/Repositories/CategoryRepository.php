<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    protected $category;
    protected $ids = [];

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function category()
    {
        return Category::with(['brands', 'groups.categories', 'subCategories'])->where("parent_id", 0)->paginate(10);
    }public function activeCategory()
    {
        return Category::with(['brands', 'groups.categories', 'subCategories'])->where("parent_id", 0)->where('status', 1)->paginate(20);
    }
    public function getData()
    {
        return Category::with(['subCategories', 'categoryImage'])->latest();
    }
    public function subcategory($category)
    {
        return Category::where("parent_id", $category)->where('status', 1)->get();
    }
    public function allSubCategory()
    {
        return Category::where("parent_id", "!=", 0)->get();
    }
    public function getAllSubSubCategoryID($category_id)
    {
        $subcats = $this->subcategory($category_id);
        $this->unlimitedSubCategory($subcats);
        return $this->ids;
    }
    private function unlimitedSubCategory($subcats)
    {
        foreach ($subcats as $subcat) {
            $this->ids[] = $subcat->id;
            $this_subcats = $this->subcategory($subcat->id);
            if ($this_subcats->count() > 0) {
                $this->unlimitedSubCategory($this_subcats);
            }
        }
    }
    public function getModel()
    {
        return $this->category;
    }
    public function getAll()
    {
        return Category::with(['parentCategory', 'brands'])->take(100)->get();
    }
    public function getActiveAll()
    {
        return Category::with('parentCategory', 'subCategories')->where('status', 1)->latest()->get();
    }
    public function getCategoryByTop()
    {

        return Category::with('parentCategory', 'subCategories')->where('status', 1)->orderBy('total_sale', 'desc')->get();
    }
    public function save($data)
    {
        if (isset($data['parent_id'])) {
            $parent_depth = Category::where('id', $data['parent_id'])->first();
            $data['depth_level'] = $parent_depth->depth_level + 1;
        } else {
            $data['depth_level'] = 1;
        }
        $data['commission_rate'] = isset($data['commission_rate']) ? $data['commission_rate'] : 0;
        $data['parent_id'] = isset($data['category_type']) ? $data['parent_id'] : 0;

        $thumbnail_image = null;
        if (isset($data['image'])) {
            $thumbnail_image = $data['image'];
            $thumbnail_image = file_upload($thumbnail_image, null, 'category');
        }
        $data['image'] = $thumbnail_image;
        $this->category->fill($data)->save();

        return true;
    }
    public function edit($id)
    {
        $category = $this->category->findOrFail($id);
        return $category;
    }
    public function update($data, $id)
    {

        $category = $this->category->find($id);
        if (isset($data['parent_id'])) {
            $parent_depth = Category::find($data['parent_id']);
            $data['depth_level'] = $parent_depth->depth_level + 1;
        } else {
            $data['depth_level'] = 1;
        }
        $data['commission_rate'] = isset($data['commission_rate']) ? $data['commission_rate'] : 0;
        $data['parent_id'] = isset($data['parent_id']) ? $data['parent_id'] : 0;

        if (isset($data['image'])) {
            $thumbnail_image = $data['image'];
            $thumbnail_image = file_upload($thumbnail_image, $category->image, 'category');
            $data['image'] = $thumbnail_image;
        }
        $category->fill($data)->save();

        return true;
    }
    public function delete($id)
    {
        $category = Category::find($id);
        if (count($category->products) > 0 || count($category->subCategories) > 0
            || count($category->newUserZoneCategories) > 0 || count($category->newUserZoneCouponCategories) > 0 ||
            count($category->MenuElements) > 0 || count($category->MenuRightPanel) > 0 || count($category->Silders) > 0 || count($category->headerCategoryPanel) > 0 ||
            count($category->homepageCustomCategories) > 0) {
            return "not_possible";
        } else {
            if ($category->categoryImage->image) {
                file_delete($category->image);
            }
            return 'possible';
        }
    }
    public function checkParentId($id)
    {
        return Category::where('parent_id', $id)->get();
    }
}
