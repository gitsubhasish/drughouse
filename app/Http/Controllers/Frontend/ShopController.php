<?php 
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = \App\Models\Category::all();
        $manufacturers = \App\Models\Manufacturer::all();

        $query = \App\Models\Medicine::with('images');

        // ✅ Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // ✅ Filter by manufacturer
        if ($request->filled('manufacturer')) {
            $query->where('manufacturer_id', $request->manufacturer);
        }

        // ✅ Filter by price range
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        // ✅ Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
            }
        }

        $medicines = $query->paginate(12);

        return view('frontend.shop', compact('medicines', 'categories', 'manufacturers'));
    }


    public function show(Medicine $medicine)
    {
        $categories = Category::all();
        $medicine->load('images', 'manufacturer', 'category', 'unit');
        return view('frontend.product-single', compact('medicine','categories'));
    }
}
