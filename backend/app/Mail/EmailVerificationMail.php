<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $userData;


    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->userData=$user;
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Email Verification Mail',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }


    public function build()
    {
        $data=$this->userData->email_verification_token;
        return $this->from('support@mahedi.com')->view('Mail.email_verification', compact('data'))->subject('Account Activation Link');
    }
}
