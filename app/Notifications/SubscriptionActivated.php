<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionActivated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $subscription;

    /**
     * Create a new notification instance.
     */
    public function __construct($subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        if (\App\Models\Setting::get('notification_subscription_activated', '1') !== '1') {
            return [];
        }
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Subscription Activated!')
                    ->greeting('Hello, ' . $notifiable->name)
                    ->line('Your subscription for ' . $this->subscription->subscriptionPlan->name . ' has been successfully activated.')
                    ->line('Start Date: ' . $this->subscription->start_date->format('d M, Y'))
                    ->line('End Date: ' . $this->subscription->end_date->format('d M, Y'))
                    ->action('View Subscription', route('candidate.subscriptions.index'))
                    ->line('You can now apply for jobs!');
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
