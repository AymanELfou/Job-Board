<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobApplicationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $jobseeker;
    public $job;

    public function __construct($jobseeker, $job)
    {
        $this->jobseeker = $jobseeker;
        $this->job = $job;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Job Application')
                    ->greeting('Hello ' . $notifiable->name)
                    ->line('A new job application has been submitted.')
                    ->line('**Job Title:** ' . $this->job->title)
                    ->line('**Applicant Name:** ' . $this->jobseeker->fullName)
                    ->line('Check your dashboard for more details.')
                    ->action('View Application', url('/employer/applications'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
