<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items.medicine']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'items.medicine');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated.');
    }

    public function invoice(Order $order)
    {
        $order->load('user', 'items.medicine');

        $pdf = Pdf::loadView('admin.orders.invoice', compact('order'));
        return $pdf->download('invoice-' . $order->id . '.pdf');
    }

    // Optional: If you need delete order
    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Order deleted.');
    }
}
