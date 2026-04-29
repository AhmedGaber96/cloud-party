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
        Schema::create('ifso_members', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
             // Title
        $table->string('title')->nullable();

        // Basic Info
        $table->string('first_name');
        $table->string('last_name');
        $table->string('email')->unique();
        $table->json('additional_emails')->nullable();

        // Location
        $table->string('city')->nullable();
        $table->string('country')->nullable();

        // Contact
        $table->string('mobile_phone')->nullable();

        // Photo
        $table->string('photo')->nullable();

        // Consent
        $table->boolean('consent')->default(false);

        // Social Media
        $table->string('facebook_url')->nullable();
        $table->string('instagram_url')->nullable();
        $table->string('linkedin_url')->nullable();
        $table->string('twitter_url')->nullable();

        // Other Info
        $table->string('abstract_no')->nullable();
        $table->year('year_of_birth')->nullable();

        // Gender
        $table->string('gender')->nullable();

        // Emergency Contact
        $table->string('emergency_contact_name')->nullable();
        $table->string('emergency_contact_relationship')->nullable();
        $table->string('emergency_contact_phone')->nullable();
        $table->string('emergency_contact_email')->nullable();

        // Workplace
        $table->string('main_workplace')->nullable();

        // Professional Role
        $table->string('professional_role')->nullable();

        // Prescriber
        $table->string('prescriber')->nullable();

        // HCP Declaration
        $table->string('hcp_declaration')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ifso_members');
    }
};
