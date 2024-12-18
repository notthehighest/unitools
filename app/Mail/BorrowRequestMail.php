<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BorrowRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $farmerName;
    public $equipmentName;
    public $borrowedDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($farmerName, $equipmentName, $borrowedDate)
    {
        $this->farmerName = $farmerName;
        $this->equipmentName = $equipmentName;
        $this->borrowedDate = $borrowedDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('farmer.emails.borrow_request')
                    ->subject('New Borrow Request')
                    ->with([
                        'farmerName' => $this->farmerName,
                        'equipmentName' => $this->equipmentName,
                        'borrowedDate' => $this->borrowedDate,
                    ]);
    }
}
