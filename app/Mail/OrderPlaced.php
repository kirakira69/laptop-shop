<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order; // Import the Order model

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    // 1. Add this public property. 
    // Data in public properties is automatically available to the view.
    public $order;

    /**
     * Create a new message instance.
     */
    // 2. Update the constructor to accept the $order variable
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // 3. Make sure this view name matches the blade file you will create
        return new Content(
            view: 'emails.order_placed',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}