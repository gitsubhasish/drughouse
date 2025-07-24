<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManufacturerController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::latest()->paginate(10);
        return view('admin.manufacturers.index', compact('manufacturers'));
    }

    public function create()
    {
        return view('admin.manufacturers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = $request->file('image')?->store('manufacturers', 'public');

        Manufacturer::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath
        ]);

        return redirect()->route('admin.manufacturers.index')->with('success', 'Manufacturer created.');
    }

    public function edit(Manufacturer $manufacturer)
    {
        return view('admin.manufacturers.edit', compact('manufacturer'));
    }

    public function update(Request $request, Manufacturer $manufacturer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($manufacturer->image) Storage::disk('public')->delete($manufacturer->image);
            $manufacturer->image = $request->file('image')->store('manufacturers', 'public');
        }

        $manufacturer->update($request->only('name', 'description'));

        return redirect()->route('admin.manufacturers.index')->with('success', 'Manufacturer updated.');
    }

    public function destroy(Manufacturer $manufacturer)
    {
        if ($manufacturer->image) Storage::disk('public')->delete($manufacturer->image);
        $manufacturer->delete();

        return redirect()->route('admin.manufacturers.index')->with('success', 'Manufacturer deleted.');
    }
}

