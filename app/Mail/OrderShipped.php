<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $orders = 
        [
            'id' => 1,
            'customer_name' => 'John Doe',
            'items' => [
                [
                    'product_name' => 'Laptop',
                    'quantity' => 1
                ],
                [
                    'product_name' => 'Mouse',
                    'quantity' => 2
                ],
            ],
            'shipping_address' => '123 Main St, Anytown USA 12345'
        ];

    protected $company_name = "LexMeet";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
       

      
    
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('jeffrey@example.com', 'Jeffrey Way'),
            replyTo: [
                new Address('taylor@example.com', 'Taylor Otwell'),
            ],
            subject: 'Order Shipped',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.name',
            with:[
                'orders' => $this->orders,
                'company_name'=> $this->company_name
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
