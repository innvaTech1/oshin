<?php

namespace App\Repositories;

use App\Models\UnitType;

class UnitTypeRepository
{
    public function getAll()
    {
        return UnitType::latest()->get();
    }

    public function getActiveAll()
    {
        return UnitType::latest()->where('status', 1)->get();
    }

    public function create(array $data)
    {
        $unit_type = new UnitType();
        $unit_type->name = $data['name'];
        $unit_type->description = $data['description'];
        $unit_type->status = $data['status'];
        $unit_type->save();
        return true;
    }

    public function find($id)
    {
        return UnitType::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $unit_type = UnitType::findOrFail($id);
        $unit_type->name = $data['name'];
        $unit_type->description = $data['description'];
        $unit_type->status = $data['status'];
        $unit_type->save();
        return true;
    }

    public function delete($id)
    {
        $unit_type = UnitType::findOrFail($id);
        if (count($unit_type->products) > 0) {
            return "not_possible";
        }
        $unit_type->delete();

        return "possible";
    }

    public function csvDownloadUnit()
    {
        if (file_exists(storage_path("app/unit_list.xlsx"))) {
            unlink(storage_path("app/unit_list.xlsx"));
        }
        // return Excel::store(new UnitExport, 'unit_list.xlsx');
    }
}
