<?php 
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use PDF;

class InvoiceController extends Controller
{
    public function download(Order $order)
    {
        $pdf = PDF::loadView('emails.invoice', ['order' => $order]);
        return $pdf->download('invoice-' . $order->id . '.pdf');
    }
}
