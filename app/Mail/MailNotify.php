<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;
    public $messageContent;
    public $title;
    public $senderName;
    public $senderEmail;
    public $bookOrderDetails;
    public $totalPrice;

    /**
     * Constructor to initialize email content and order details
     *
     * @param string $messageContent Content of the message
     * @param string $title Title of the email
     * @param array $bookOrderDetails Details of the book order
     * @param float $totalPrice Total price of the order
     */
    public function __construct($messageContent, $title, $bookOrderDetails,$totalPrice)
    {
        $this->messageContent = $messageContent;
        $this->title = $title;
        $this->senderName = "BookStore";
        $this->senderEmail = "gietconheo88@gmail.com";
        $this->bookOrderDetails = $bookOrderDetails;
        $this->totalPrice = $totalPrice;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'title' => $this->title,
            'totalPrice' => $this->totalPrice,
            'messageContent' => $this->messageContent,
            'bookOrderDetails' => $this->bookOrderDetails
        ];
    
        return $this->from($this->senderEmail, $this->senderName)
                    ->subject($this->title)
                    ->view('admin.pages.emails.order', compact('data'));
    }
}
