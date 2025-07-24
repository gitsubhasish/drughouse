<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pincode;
use Illuminate\Http\Request;

class PincodeController extends Controller
{
    public function index()
    {
        $pincodes = Pincode::paginate(10);
        return view('admin.pincodes.index', compact('pincodes'));
    }

    public function create()
    {
        return view('admin.pincodes.create');
    }

    public function store(Request $request)
    {
        $request->validate(['pincode' => 'required|digits:6|unique:pincodes,pincode']);
        Pincode::create($request->only('pincode'));
        return redirect()->route('admin.pincodes.index')->with('success', 'Pincode added successfully');
    }

    public function edit(Pincode $pincode)
    {
        return view('admin.pincodes.edit', compact('pincode'));
    }

    public function update(Request $request, Pincode $pincode)
    {
        $request->validate(['pincode' => 'required|digits:6|unique:pincodes,pincode,' . $pincode->id]);
        $pincode->update($request->only('pincode'));
        return redirect()->route('admin.pincodes.index')->with('success', 'Pincode updated successfully');
    }

    public function destroy(Pincode $pincode)
    {
        $pincode->delete();
        return redirect()->route('admin.pincodes.index')->with('success', 'Pincode deleted successfully');
    }
}
