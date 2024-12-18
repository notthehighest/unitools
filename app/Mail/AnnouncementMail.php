<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AnnouncementMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $description;
    public $date;

    public function __construct($title, $description, $date)
    {
        $this->title = $title;
        $this->description = $description;
        $this->date = $date;
    }

    public function build()
    {
        return $this->view('admin.emails.announcement')
                    ->subject('New Announcement from Pagkakaisa Farmers Association')
                    ->with([
                        'title' => $this->title,
                        'description' => $this->description,
                        'date' => $this->date,
                    ]);
    }
}
