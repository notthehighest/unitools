<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BorrowRequestStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $equipmentName;
    public $borrowedDate;
    public $status;

    /**
     * Create a new message instance.
     *
     * @param $userName
     * @param $equipmentName
     * @param $borrowedDate
     * @param $status
     */
    public function __construct($userName, $equipmentName, $borrowedDate, $status)
    {
        $this->userName = $userName;
        $this->equipmentName = $equipmentName;
        $this->borrowedDate = $borrowedDate;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.emails.borrow_request_status')
                    ->subject('Borrow Request Status Update')
                    ->with([
                        'userName' => $this->userName,
                        'equipmentName' => $this->equipmentName,
                        'borrowedDate' => $this->borrowedDate,
                        'status' => $this->status,
                    ]);
    }
}
