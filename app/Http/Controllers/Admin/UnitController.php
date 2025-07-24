<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::paginate(10);
        return view('admin.units.index', compact('units'));
    }

    public function create()
    {
        return view('admin.units.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Unit::create($request->only('name'));
        return redirect()->route('admin.units.index')->with('success', 'Unit added successfully');
    }

    public function edit(Unit $unit)
    {
        return view('admin.units.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $unit->update($request->only('name'));
        return redirect()->route('admin.units.index')->with('success', 'Unit updated successfully');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('admin.units.index')->with('success', 'Unit deleted successfully');
    }
}
