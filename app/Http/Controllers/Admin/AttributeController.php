<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RedirectType;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Services\AttributeService;
use App\Traits\LogActivity;
use App\Traits\RedirectHelperTrait;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    use RedirectHelperTrait;
    protected $attributeService;
    public function __construct(AttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = $this->attributeService->getAll();
        return view('admin.pages.attributes.index', compact('attributes'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeRequest $request)
    {
        try {
            $this->attributeService->save($request->except("_token"));
            LogActivity::successLog('Attribute Added.');

            return $this->redirectWithSession(RedirectType::CREATE->value, "admin.attribute.index");
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return $this->redirectWithSession(RedirectType::ERROR->value);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
