<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Unit;
use App\Models\MedicineImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MedicinesImport;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        // Filtering/Search
        $query = Medicine::with(['category', 'manufacturer']);

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->manufacturer_id) {
            $query->where('manufacturer_id', $request->manufacturer_id);
        }
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->is_featured !== null) {
            $query->where('is_featured', $request->is_featured);
        }

        $medicines = $query->latest()->paginate(10);
        $categories = Category::all();
        $manufacturers = Manufacturer::all();

        return view('admin.medicines.index', compact('medicines', 'categories', 'manufacturers'));
    }

    public function create()
    {
        $categories = Category::all();
        $manufacturers = Manufacturer::all();
        $units = Unit::all();
        return view('admin.medicines.create', compact('categories', 'manufacturers', 'units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            //'expiry_date' => 'required|date',
            'total_stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'is_featured' => 'nullable|boolean',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $medicine = Medicine::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'expiry_date' => $request->expiry_date,
            'total_stock' => $request->total_stock,
            'is_featured' => $request->is_featured ?? false,
            'category_id' => $request->category_id,
            'manufacturer_id' => $request->manufacturer_id,
            'batch_no' => $request->batch_no,
            'mrp' => $request->mrp
        ]);

        // Save multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('medicines', 'public');
                MedicineImage::create([
                    'medicine_id' => $medicine->id,
                    'image' => $path
                ]);
            }
        }

        return redirect()->route('admin.medicines.index')->with('success', 'Medicine added successfully.');
    }

    public function edit(Medicine $medicine)
    {
        $categories = Category::all();
        $manufacturers = Manufacturer::all();
        $units = Unit::all();
        return view('admin.medicines.edit', compact('medicine', 'categories', 'manufacturers', 'units'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            //'expiry_date' => 'required|date',
            'total_stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'is_featured' => 'nullable|boolean',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $medicine->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'expiry_date' => $request->expiry_date,
            'total_stock' => $request->total_stock,
            'is_featured' => $request->is_featured ?? false,
            'category_id' => $request->category_id,
            'manufacturer_id' => $request->manufacturer_id,
            'batch_no' => $request->batch_no,
            'mrp' => $request->mrp
        ]);

        // Add new images if uploaded
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('medicines', 'public');
                MedicineImage::create([
                    'medicine_id' => $medicine->id,
                    'image' => $path
                ]);
            }
        }

        return redirect()->route('admin.medicines.index')->with('success', 'Medicine updated.');
    }

    public function destroy(Medicine $medicine)
    {
        // Delete all images
        foreach ($medicine->images as $img) {
            Storage::disk('public')->delete($img->image);
            $img->delete();
        }
        $medicine->delete();
        return redirect()->route('admin.medicines.index')->with('success', 'Medicine deleted.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new MedicinesImport, $request->file('file'));

        return back()->with('success', 'Medicines imported successfully!');
    }
}
