<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RedirectType;
use App\Http\Controllers\Controller;
use App\Services\UnitTypeService;
use App\Traits\LogActivity;
use App\Traits\RedirectHelperTrait;
use Illuminate\Http\Request;

class UnitTypeController extends Controller
{
    use RedirectHelperTrait;
    protected $unitTypeService;

    public function __construct(UnitTypeService $unitTypeService)
    {
        $this->unitTypeService = $unitTypeService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = $this->unitTypeService->getAll();
        return view('admin.pages.unit-types.index', compact('units'));
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
    public function store(Request $request)
    {
        try {
            $this->unitTypeService->save($request->except("_token"));
            LogActivity::successLog('Units added.');
            return $this->redirectWithSession(RedirectType::CREATE->value, "admin.unit.index");

        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return $this->redirectWithSession(RedirectType::ERROR->value, "admin.unit.index");
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
        try {
            $this->unitTypeService->update($request->except("_token"), $id);
            LogActivity::successLog('Units updated.');
            return $this->redirectWithSession(RedirectType::UPDATE->value, "admin.unit.index");
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return $this->redirectWithSession(RedirectType::ERROR->value, "admin.unit.index");
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $result = $this->unitTypeService->delete($id);
            if ($result == "not_possible") {
                return $this->redirectWithSession(RedirectType::ERROR->value, "admin.unit.index");
            }
            LogActivity::successLog('unit delete successful.');
            return $this->redirectWithSession(RedirectType::DELETE->value, "admin.unit.index");
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage() . ' - Error has been detected for Unit Destroy');
            return $this->redirectWithSession(RedirectType::ERROR->value, "admin.unit.index");
        }

    }
}
