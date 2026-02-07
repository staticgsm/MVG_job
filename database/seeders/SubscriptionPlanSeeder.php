<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SubscriptionPlan::create([
            'name' => 'Basic Plan',
            'price' => 499.00,
            'duration_days' => 30,
            'description' => 'Perfect for starters. valid for 30 days.',
            'is_active' => true,
        ]);

        \App\Models\SubscriptionPlan::create([
            'name' => 'Premium Plan',
            'price' => 1299.00,
            'duration_days' => 90,
            'description' => 'Best value. Valid for 90 days.',
            'is_active' => true,
        ]);
    }
}
