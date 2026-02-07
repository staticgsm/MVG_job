<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationStatusChanged extends Notification implements ShouldQueue
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
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // Maybe distinct toggle for status changes? For now, we can group it or leave it always on. 
        // Let's assume it shares 'job_application_submitted' OR has no toggle yet.
        // I'll leave it always on for now as status changes are critical.
        // Actually, user didn't ask for a toggle for this specific one, but good to have.
        // I will add a check if the key exists, default true.
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Application Status Update: ' . $this->application->jobPost->title)
                    ->greeting('Hello, ' . $notifiable->name)
                    ->line('The status of your application for "' . $this->application->jobPost->title . '" has changed.')
                    ->line('New Status: **' . ucfirst($this->application->status) . '**')
                    ->line('Remarks: ' . ($this->application->remarks ?? 'N/A'))
                    ->action('Check Status', route('candidate.applications.index'))
                    ->line('Thank you for your patience.');
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
