<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        $pdf = PDF::loadView('emails.invoice', ['order' => $this->order]);

        return $this->subject('Your Invoice - Order #' . $this->order->id)
                    ->view('emails.invoice')
                    ->with(['order' => $this->order])
                    ->attachData($pdf->output(), 'invoice-'.$this->order->id.'.pdf');
    }
}
