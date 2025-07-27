<?php 
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Medicine;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('frontend.cart', compact('cart', 'total','categories'));
    }

    public function add(Request $request, Medicine $medicine)
    {
        $cart = session()->get('cart', []);

        $quantity = $request->quantity ?? 1;

        if (isset($cart[$medicine->id])) {
            $cart[$medicine->id]['quantity'] += $quantity;
        } else {
            $cart[$medicine->id] = [
                'name' => $medicine->name,
                'price' => $medicine->price,
                'image' => $medicine->images->first() 
                    ? $medicine->images->first()->image 
                    : 'images/no-image.jpg',
                'quantity' => $quantity
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
       $categories = Category::all();
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Cart updated successfully.');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Item removed from cart.');
    }
}
