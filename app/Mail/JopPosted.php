<?php

namespace App\Mail;

use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JopPosted extends Mailable
{
    use Queueable, SerializesModels;

    public $foo = 'bar';

    /**
     * Create a new message instance.
     */
    // any objects injected into the construct (public ones) are accessible in the view
    public function __construct(public Job  $job)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Jop Posted',
        );
    }

    /**
     * Get the message content definition.
     */

    // in this view we will have access to the $foo and $job variables defined above
    public function content(): Content
    {
        return new Content(
            view: 'mail.job-posted',
                // we can use this if we want to access a specific attr from the object $job without passing the whole thing
                // and we need to make the public injection in __construct protected for that
//            with: [
//                'title' => $this->job->title,
//                'foo' => 'bar'
//            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
