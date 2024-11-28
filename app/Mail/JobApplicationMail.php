<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $jobTitle;
    public $jobSeekerName;

    public function __construct($jobTitle, $jobSeekerName)
    {
        $this->jobTitle = $jobTitle;
        $this->jobSeekerName = $jobSeekerName;
    }

    public function build()
    {
        return $this->subject('New Job Application')
                    ->view('emails.job_application_notification')
                    ->with([
                        'jobTitle' => $this->jobTitle,
                        'jobSeekerName' => $this->jobSeekerName,
                    ]);;
    }










/* 

    /**
     * Get the message envelope.
     */
   /*  public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Job Application Mail',
        );
    } */

    /**
     * Get the message content definition.
     */
   /*  public function content(): Content
    {
        return new Content(
            view: 'view.emails.job_application_notification',
        );
    } */

    
}
 