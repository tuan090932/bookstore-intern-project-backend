<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $messageContent;
    public $title;
    public $senderName;
    public $senderEmail;
    public $bookOrderDetails;
    public $totalPrice;

    public function __construct($messageContent, $title, $bookOrderDetails, $totalPrice)
    {
        $this->messageContent = $messageContent;
        $this->title = $title;
        $this->senderName = "BookStore";
        $this->senderEmail = "gietconheo88@gmail.com";
        $this->bookOrderDetails = $bookOrderDetails;
        $this->totalPrice = $totalPrice;
    }
    
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
