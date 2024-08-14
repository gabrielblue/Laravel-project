<?php

namespace App\Notifications;

// app/Notifications/ApplicationDenied.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationDenied extends Notification
{
    use Queueable;

    protected $application;

    /**
     * Create a new notification instance.
     */
    public function __construct($application)
    {
        $this->application = $application;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Job Application Denied')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('We regret to inform you that your application for the job "' . $this->application->job->title . '" has been denied.')
            ->line('Thank you for your interest in the position.')
            ->action('View More Jobs', url('/jobs'))
            ->line('Thank you for using our application!');
    }
}
