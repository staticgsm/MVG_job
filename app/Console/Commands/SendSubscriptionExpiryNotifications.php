<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendSubscriptionExpiryNotifications extends Command
{
    protected $signature = 'subscriptions:notify-expiry';

    protected $description = 'Notify users whose subscriptions are expiring in 3 days';

    public function handle()
    {
        $days = 3;
        $date = \Carbon\Carbon::now()->addDays($days)->toDateString();

        $this->info("Checking for subscriptions expiring on {$date}...");

        $subscriptions = \App\Models\UserSubscription::where('status', 'active')
            ->whereDate('end_date', $date)
            ->with(['user', 'subscriptionPlan'])
            ->get();

        foreach ($subscriptions as $sub) {
            if ($sub && $sub->user) {
                // Ensure notification class exists and is imported or fully qualified
                $sub->user->notify(new \App\Notifications\SubscriptionExpiring($sub));
                $this->info("Notified User ID: {$sub->user_id}");
            }
        }

        $this->info('Done.');
    }
}
