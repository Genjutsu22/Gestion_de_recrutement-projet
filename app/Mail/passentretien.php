<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class passentretien extends Mailable
{
    public $prof;
    public $depart;
    public $date;
    /**
     * Create a new message instance.
     *
     * @param string $otp
     * @return void
     */
    public function __construct($prof,$depart,$date)
    {
        $this->prof = $prof;
        $this->depart = $depart;
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Entretien d\'embauche')
            ->view('emails.accept_job')
            ->with(['prof' => $this->prof,'depart'=>$this->depart,'date'=>$this->date]);
    }
}
