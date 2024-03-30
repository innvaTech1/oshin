<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RedirectType;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoeryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use App\Traits\LogActivity;
use App\Traits\RedirectHelperTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    use RedirectHelperTrait;
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->categoryService->save($request->except('_token'));
            DB::commit();
            LogActivity::successLog('Category Added.');
            return $this->redirectWithMessage(RedirectType::CREATE->value, 'admin.category.index');

        } catch (Exception $e) {
            DB::rollBack();

            LogActivity::errorLog($e->getMessage());
            return $this->redirectWithMessage(RedirectType::ERROR->value, 'admin.category.index');

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $category = $this->categoryService->editById($id);
            return response()->json($category);
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'status' => false,
                'message' => $e,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoeryRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $this->categoryService->update($request->except('_token'), $id);
            DB::commit();
            LogActivity::successLog('Category Updated.');
            return $this->redirectWithMessage(RedirectType::UPDATE->value, 'admin.category.index');
            return $this->loadTableData();
        } catch (Exception $e) {
            DB::rollBack();
            LogActivity::errorLog($e->getMessage());
            return $this->redirectWithMessage(RedirectType::ERROR->value, 'admin.category.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $parent_id = $this->categoryService->checkParentId($id);

            if ($parent_id->count() > 0) {
                return $this->redirectWithMessage(RedirectType::ERROR->value, 'admin.category.index', [], ['message' => 'Sorry This id related with another category']);
            }
            $result = $this->categoryService->deleteById($id);

            if ($result == "not_possible") {
                return $this->redirectWithMessage(RedirectType::ERROR->value, 'admin.category.index', [], ['message' => 'Related data exist in multiple directory']);
            }
            LogActivity::successLog('category delete successful.');
            return $this->redirectWithMessage(RedirectType::DELETE->value, 'admin.category.index');
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return $this->redirectWithMessage(RedirectType::ERROR->value, 'admin.category.index');
        }

    }

    public function getSubCategory($id){
        try {
            $category = $this->categoryService->getCategoryById($id);
            return response()->json($category);
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'status' => false,
                'message' => $e,
            ]);
        }
    }
}
