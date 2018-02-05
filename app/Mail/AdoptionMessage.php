<?php

namespace App\Mail;

use App\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdoptionMessage extends Mailable
{
    use Queueable, SerializesModels;
    protected $m; //stocam entitatea mesaj transmisa in constructor la 21

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Message $m)
    {
        $this->m = $m;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.AdoptionMessage')     //transmisie catre view
                    ->with([
                        'user_name' => $this->m->name,
                        'user_email' => $this->m->email,
                        'user_phone' => $this->m->phone,
                        'user_message' => $this->m->message,
                        'dog_id' => $this->m->dog_id,
                        'dog_name' =>$this->m->dog->name,
                    ]);
    }
}