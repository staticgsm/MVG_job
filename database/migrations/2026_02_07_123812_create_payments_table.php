<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('payments')) {
            Schema::create('payments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('subscription_plan_id')->constrained()->onDelete('cascade');
                $table->string('txnid')->unique();
                $table->decimal('amount', 10, 2);
                $table->string('currency')->default('INR');
                $table->enum('status', ['initiated', 'pending', 'success', 'failed'])->default('initiated');
                $table->string('gateway')->default('payu');
                $table->string('bank_ref_num')->nullable();
                $table->string('mihpayid')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
