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
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->unsignedBigInteger('user_id'); // User table
            $table->unsignedBigInteger('blood_group_id'); // Blood group
            $table->date('date_of_birth');
            $table->string('gender')->nullable();
            $table->date('last_donation_date')->nullable();
            $table->string('district');
            $table->string('upazila');
            $table->tinyInteger('is_available')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};
