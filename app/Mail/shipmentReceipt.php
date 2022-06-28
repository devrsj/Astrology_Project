<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class shipmentReceipt extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $shipment;
    public $items;
    public $subject;
    public function __construct($shipment,$items=[],$subject='Shipment Invoice')
    {
        $this->shipment=$shipment;
        $this->items = $items;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject($this->subject)->markdown('admin.shipment.print',['shipment'=>$this->shipment,'items'=>$this->items]);
    }
}
