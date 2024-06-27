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

    /**
     * Create a new message instance.
     */
    public function __construct($messageContent, $title, $bookOrderDetails, $senderName="BookStore", $senderEmail="gietconheo88@gmail.com")
    {
        $this->messageContent = $messageContent;
        $this->title = $title;
        $this->senderName = $senderName;
        $this->senderEmail = $senderEmail;
        $this->bookOrderDetails = $bookOrderDetails;
    }
    
    /**
     * Build the message.
     */
    public function build()
    {
        $htmlContent = '<p>' . $this->messageContent . '</p>';
        $htmlContent .= '<table border="1" cellpadding="5" cellspacing="0">';
        $htmlContent .= '<thead><tr><th>Book ID</th><th>Title</th><th>Quantity</th><th>Price</th></tr></thead>';
        $htmlContent .= '<tbody>';

        // Add each book order detail to the table
        foreach ($this->bookOrderDetails as $detail) {
            $htmlContent .= '<tr>';
            $htmlContent .= '<td>' . $detail['book_id'] . '</td>';
            $htmlContent .= '<td>' . $detail['title'] . '</td>'; 
            $htmlContent .= '<td>' . $detail['quantity'] . '</td>';
            $htmlContent .= '<td>' . $detail['price'] . '</td>';
            $htmlContent .= '</tr>';
        }
        $htmlContent .= '</tbody></table>';
        return $this->from($this->senderEmail, $this->senderName)
                    ->subject($this->title)
                    ->html($htmlContent);
    }
}
