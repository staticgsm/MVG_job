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
        Schema::table('job_posts', function (Blueprint $table) {
            if (!Schema::hasColumn('job_posts', 'skills_required')) {
                $table->json('skills_required')->nullable()->after('description');
            }
            if (!Schema::hasColumn('job_posts', 'education_required')) {
                // If skills_required exists (or was just added), put education after it.
                // If not, put after description. But we just added skills_required above so it should exist conceptually.
                // However, in same transaction, it might be tricky. Let's just say after description for safety or use after skills_required.
                $table->json('education_required')->nullable()->after('description');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_posts', function (Blueprint $table) {
            $table->dropColumn('education_required');
        });
    }
};
