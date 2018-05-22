<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    protected $title;
    public $view;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $title, $view)
    {
        $this->data = $data;
        $this->title = $title;
        $this->view = $view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->title)
            ->view($this->view)
            ->with([
                'data'    => $this->data,
            ]);
    }
}
