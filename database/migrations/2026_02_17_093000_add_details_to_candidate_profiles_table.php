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
        Schema::table('candidate_profiles', function (Blueprint $table) {
            $table->string('middle_name')->nullable()->after('first_name');
            $table->string('photo_path')->nullable()->after('user_id');
            $table->string('aadhaar_no')->nullable()->after('phone');
            $table->string('category')->nullable()->after('dob'); // SC, ST, etc.
            $table->string('district')->nullable()->after('address');
            $table->string('taluka')->nullable()->after('district');
            $table->string('highest_education')->nullable()->after('resume_path');
            $table->text('experience')->nullable()->after('highest_education');
            $table->string('aadhaar_doc_path')->nullable()->after('experience');
            $table->string('education_doc_path')->nullable()->after('aadhaar_doc_path');
            $table->string('bank_doc_path')->nullable()->after('education_doc_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'middle_name',
                'photo_path',
                'aadhaar_no',
                'category',
                'district',
                'taluka',
                'highest_education',
                'experience',
                'aadhaar_doc_path',
                'education_doc_path',
                'bank_doc_path',
            ]);
        });
    }
};
