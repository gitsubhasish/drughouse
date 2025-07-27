<?php 
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pincode;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Medicine;
use Illuminate\Support\Facades\DB;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('frontend.checkout', compact('cart', 'total','categories'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required|string|max:255',
            'pincode' => 'required|numeric',
        ]);

        // ✅ Pincode Validation
        if (!Pincode::where('pincode', $request->pincode)->exists()) {
            return back()->withErrors(['pincode' => 'Delivery not available to this pincode.'])->withInput();
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->withErrors(['cart' => 'Your cart is empty.']);
        }

        DB::beginTransaction();
        try {
            // ✅ Create Order (No user_id for now)
            $order = Order::create([
                'user_id' => auth()->check() ? auth()->id() : 1,
                'customer_name' => $request->name,
                'customer_email' => $request->email,
                'customer_phone' => $request->phone,
                'total_amount' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
                'status' => 'pending',
                'address' => $request->address,
                'pincode' => $request->pincode,
            ]);

            // ✅ Create Order Items & Reduce Stock
            foreach ($cart as $id => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'medicine_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                Medicine::where('id', $id)->decrement('total_stock', $item['quantity']);
            }

            DB::commit();
            session()->forget('cart');
            Mail::to($request->email)->send(new InvoiceMail($order));
            return redirect()
            ->route('cart.index')
            ->with([
                'success' => 'Order placed successfully! Invoice sent to your email.',
                'order_id' => $order->id
            ]);
        } catch (\Exception $e) {
            print_r($e->getMessage()); exit;
            DB::rollBack();
            return back()->withErrors(['error' => 'Something went wrong. Please try again.'])->withInput();
        }
    }
}