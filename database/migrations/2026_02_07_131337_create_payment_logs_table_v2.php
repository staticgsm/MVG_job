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
        if (! Schema::hasTable('payment_logs')) {
            Schema::create('payment_logs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('payment_id')->nullable()->constrained()->onDelete('set null');
                $table->string('txnid')->nullable();
                $table->string('mihpayid')->nullable();
                $table->string('status')->nullable();
                $table->text('error_message')->nullable();
                $table->json('raw_response')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_logs_table_v2');
    }
};
