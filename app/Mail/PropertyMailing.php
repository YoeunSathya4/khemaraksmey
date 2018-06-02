<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PropertyMailing extends Mailable
{
    use Queueable, SerializesModels;

    public  $properties;
    public  $record;
    public function __construct($record, $properties)
    {
        $this->properties = $properties;
        $this->record = $record;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //echo $this->message->subject; die;
        return $this->view('emails.PropertyMailing'); //->with(['message'=>$this->message, 'properties'=>$this->properties]);
    }
}
