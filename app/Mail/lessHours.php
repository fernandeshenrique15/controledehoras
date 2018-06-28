<?php

namespace ControleDeHoras\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class lessHours extends Mailable
{
    use Queueable, SerializesModels;

    protected $work;

    public function __construct($work)
    {
        $this->work = $work;
    }

    public function build()
    {
        return $this->view('mail.less')
            ->with([
                'name' => $this->work->name,
                'hours' => $this->work->hours,
                'email' => $this->work->email
            ]);
    }
}
